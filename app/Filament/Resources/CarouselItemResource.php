<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarouselItemResource\Pages;
use App\Models\CarouselItem;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class CarouselItemResource extends Resource
{
    protected static ?string $model = CarouselItem::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-photo';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Schemas\Components\Section::make('Carousel Item Details')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('carousel')
                            ->columnSpanFull()
                            ->helperText('Recommended size: 1920x600px or similar wide format'),
                        Forms\Components\RichEditor::make('overlay_text')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('button_text')
                            ->maxLength(255)
                            ->helperText('Optional: Text for the action button'),
                        Forms\Components\TextInput::make('button_url')
                            ->url()
                            ->maxLength(255)
                            ->helperText('Optional: URL for the action button'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                    
                Schemas\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->size(60),
                Tables\Columns\TextColumn::make('overlay_text')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('button_text')
                    ->limit(30),
                Tables\Columns\TextColumn::make('button_url')
                    ->limit(30),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
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
            ->defaultSort('order');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarouselItems::route('/'),
            'create' => Pages\CreateCarouselItem::route('/create'),
            'edit' => Pages\EditCarouselItem::route('/{record}/edit'),
        ];
    }
}

