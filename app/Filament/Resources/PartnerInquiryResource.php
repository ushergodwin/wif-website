<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerInquiryResource\Pages;
use App\Models\PartnerInquiry;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PartnerInquiryResource extends Resource
{
    protected static ?string $model = PartnerInquiry::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-building-office-2';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Interactions';
    }

    public static function getNavigationLabel(): string
    {
        return 'Partner Inquiries';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Section::make('Inquiry Details')
                ->schema([
                    Forms\Components\TextInput::make('organization_name')
                        ->disabled(),
                    Forms\Components\TextInput::make('contact_person')
                        ->disabled(),
                    Forms\Components\TextInput::make('email')
                        ->disabled(),
                    Forms\Components\TextInput::make('phone')
                        ->disabled(),
                    Forms\Components\Select::make('partnership_type')
                        ->options([
                            'corporate' => 'Corporate',
                            'ngo'       => 'NGO',
                            'media'     => 'Media',
                            'training'  => 'Training',
                            'other'     => 'Other',
                        ])
                        ->disabled(),
                    Forms\Components\Select::make('status')
                        ->options([
                            'pending'   => 'Pending',
                            'reviewed'  => 'Reviewed',
                            'contacted' => 'Contacted',
                            'rejected'  => 'Rejected',
                        ])
                        ->required(),
                ])
                ->columns(2),

            Forms\Components\Section::make('Partnership Interest & Message')
                ->schema([
                    Forms\Components\Textarea::make('partnership_interest')
                        ->disabled()
                        ->rows(4)
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('message')
                        ->disabled()
                        ->rows(4)
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('organization_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_person')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('phone')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BadgeColumn::make('partnership_type')
                    ->label('Type')
                    ->colors([
                        'primary' => 'corporate',
                        'success' => 'ngo',
                        'warning' => 'media',
                        'info'    => 'training',
                        'gray'    => 'other',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state ?? '-')),
                Tables\Columns\TextColumn::make('partnership_interest')
                    ->label('Interest')
                    ->limit(60)
                    ->toggleable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info'    => 'reviewed',
                        'success' => 'contacted',
                        'danger'  => 'rejected',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending'   => 'Pending',
                        'reviewed'  => 'Reviewed',
                        'contacted' => 'Contacted',
                        'rejected'  => 'Rejected',
                    ]),
                Tables\Filters\SelectFilter::make('partnership_type')
                    ->label('Type')
                    ->options([
                        'corporate' => 'Corporate',
                        'ngo'       => 'NGO',
                        'media'     => 'Media',
                        'training'  => 'Training',
                        'other'     => 'Other',
                    ]),
            ])
            ->actions([
                Actions\ViewAction::make(),
                Actions\EditAction::make()->label('Update Status'),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartnerInquiries::route('/'),
            'view'  => Pages\ViewPartnerInquiry::route('/{record}'),
            'edit'  => Pages\EditPartnerInquiry::route('/{record}/edit'),
        ];
    }
}
