<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkPlanResource\Pages;
use App\Filament\Resources\WorkPlanResource\RelationManagers\EventsRelationManager;
use App\Models\WorkPlan;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class WorkPlanResource extends Resource
{
    protected static ?string $model = WorkPlan::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-calendar-days';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }

    public static function getNavigationLabel(): string
    {
        return 'Work Plans';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Schemas\Components\Section::make('Work Plan Details')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('e.g. WIF 2025 Annual Work Plan'),
                    Forms\Components\TextInput::make('year')
                        ->numeric()
                        ->placeholder(date('Y'))
                        ->helperText('The year this work plan covers'),
                    Forms\Components\Textarea::make('description')
                        ->rows(3)
                        ->columnSpanFull()
                        ->placeholder('Brief overview of this work plan...'),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Active')
                        ->default(true)
                        ->helperText('Only active work plans are shown on the website'),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year')
                    ->sortable(),
                Tables\Columns\TextColumn::make('events_count')
                    ->counts('events')
                    ->label('Events')
                    ->badge(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('year', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            EventsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListWorkPlans::route('/'),
            'create' => Pages\CreateWorkPlan::route('/create'),
            'edit'   => Pages\EditWorkPlan::route('/{record}/edit'),
        ];
    }
}
