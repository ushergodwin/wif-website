<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Actions;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'galleryItems';

    protected static ?string $title = 'Gallery Images';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\FileUpload::make('image')
                ->image()
                ->required()
                ->disk('public')
                ->directory('gallery')
                ->columnSpanFull(),

            Forms\Components\TextInput::make('title')
                ->maxLength(255),

            Forms\Components\TextInput::make('year')
                ->numeric()
                ->minValue(2000)
                ->maxValue(2100),

            Forms\Components\Textarea::make('description')
                ->rows(2)
                ->columnSpanFull(),

            Forms\Components\TextInput::make('order')
                ->numeric()
                ->default(0),

            Forms\Components\Toggle::make('is_active')
                ->label('Active')
                ->default(true),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->defaultSort('order')
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->square()
                    ->size(64),

                Tables\Columns\TextColumn::make('title')
                    ->default('(no title)')
                    ->searchable(),

                Tables\Columns\TextColumn::make('year')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
