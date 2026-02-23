<?php

namespace App\Filament\Resources\WorkPlanResource\RelationManagers;

use Filament\Actions;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class EventsRelationManager extends RelationManager
{
    protected static string $relationship = 'events';

    protected static ?string $title = 'Events';

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->columnSpanFull()
                ->placeholder('Event title'),
            Forms\Components\DatePicker::make('date')
                ->required()
                ->native(false),
            Forms\Components\TextInput::make('location')
                ->maxLength(255)
                ->placeholder('Venue or city'),
            Forms\Components\TextInput::make('theme')
                ->maxLength(255)
                ->placeholder('Optional theme or category'),
            Forms\Components\TextInput::make('order')
                ->numeric()
                ->default(0)
                ->helperText('Display order (lower = first, overrides date sorting)'),
            Forms\Components\Textarea::make('description')
                ->rows(4)
                ->columnSpanFull()
                ->placeholder('Full description of the event...'),
        ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('location')
                    ->limit(30)
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('theme')
                    ->badge()
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
            ])
            ->defaultSort('date')
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
