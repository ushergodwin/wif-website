<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageSectionResource\Pages;
use App\Models\PageSection;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PageSectionResource extends Resource
{
    protected static ?string $model = PageSection::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-document-text';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Schemas\Components\Section::make('Section Information')
                    ->schema([
                        Forms\Components\Select::make('page')
                            ->required()
                            ->options([
                                'home' => 'Homepage',
                                'about' => 'About Page',
                            ])
                            ->searchable(),
                        Forms\Components\TextInput::make('section_key')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Unique identifier (e.g., about-snapshot, vision, mission, core-values)'),
                        Forms\Components\Select::make('section_type')
                            ->required()
                            ->options([
                                'text' => 'Text Content',
                                'image_text' => 'Image + Text',
                                'list' => 'List Items',
                                'values' => 'Core Values',
                                'objectives' => 'Objectives',
                                'cta' => 'Call to Action',
                            ])
                            ->default('text'),
                        Forms\Components\TextInput::make('title')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('subtitle')
                            ->rows(2),
                        Forms\Components\RichEditor::make('content')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->directory('page-sections')
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('items')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required(),
                                Forms\Components\Textarea::make('description')
                                    ->rows(2),
                                Forms\Components\TextInput::make('icon')
                                    ->helperText('Font Awesome icon class (e.g., fas fa-check-circle)'),
                            ])
                            ->columnSpanFull()
                            ->visible(fn ($get) => in_array($get('section_type'), ['list', 'values', 'objectives'])),
                        Forms\Components\Select::make('background_color')
                            ->options([
                                'light' => 'Light',
                                'white' => 'White',
                                'primary' => 'Primary (Red)',
                                'secondary' => 'Secondary (Green)',
                            ])
                            ->default('white'),
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
                Tables\Columns\TextColumn::make('page')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('section_key')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('section_type')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->limit(30)
                    ->searchable(),
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
                Tables\Filters\SelectFilter::make('page')
                    ->options([
                        'home' => 'Homepage',
                        'about' => 'About Page',
                    ]),
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
            'index' => Pages\ListPageSections::route('/'),
            'create' => Pages\CreatePageSection::route('/create'),
            'edit' => Pages\EditPageSection::route('/{record}/edit'),
        ];
    }
}

