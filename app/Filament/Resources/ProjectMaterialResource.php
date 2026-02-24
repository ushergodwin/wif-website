<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectMaterialResource\Pages;
use App\Models\Project;
use App\Models\ProjectMaterial;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectMaterialResource extends Resource
{
    protected static ?string $model = ProjectMaterial::class;

    protected static ?string $navigationLabel = 'Project Materials';

    protected static ?int $navigationSort = 3;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-folder-open';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Schemas\Components\Section::make('Material Details')
                ->schema([
                    Forms\Components\Select::make('project_id')
                        ->label('Project')
                        ->options(Project::where('is_active', true)->orderBy('title')->pluck('title', 'id'))
                        ->searchable()
                        ->required(),
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('e.g. Monologue Challenge Submission Guide'),
                    Forms\Components\Textarea::make('description')
                        ->rows(2)
                        ->columnSpanFull()
                        ->placeholder('Brief description of what this material covers.'),
                    Forms\Components\FileUpload::make('file_path')
                        ->label('File')
                        ->required()
                        ->disk('public')
                        ->directory('project-materials')
                        ->acceptedFileTypes(['application/pdf', 'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-powerpoint',
                            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                            'image/jpeg', 'image/png', 'image/gif', 'image/webp',
                            'application/zip', 'application/x-rar-compressed'])
                        ->maxSize(20480) // 20 MB
                        ->columnSpanFull()
                        ->helperText('Accepted: PDF, Word, Excel, PowerPoint, Images, ZIP/RAR. Max 20 MB.'),
                    Forms\Components\TextInput::make('order')
                        ->numeric()
                        ->default(0)
                        ->helperText('Lower numbers appear first.'),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Visible to public')
                        ->default(true),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.title')
                    ->label('Project')
                    ->sortable()
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('file_path')
                    ->label('File Type')
                    ->formatStateUsing(fn ($state) => strtoupper(pathinfo($state, PATHINFO_EXTENSION)))
                    ->badge()
                    ->color(fn ($state) => match (strtolower(pathinfo($state, PATHINFO_EXTENSION))) {
                        'pdf'         => 'danger',
                        'doc', 'docx' => 'primary',
                        'xls', 'xlsx' => 'success',
                        default       => 'gray',
                    }),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('project_id')
            ->filters([
                Tables\Filters\SelectFilter::make('project_id')
                    ->label('Project')
                    ->options(Project::where('is_active', true)->orderBy('title')->pluck('title', 'id'))
                    ->searchable(),
                Tables\Filters\TernaryFilter::make('is_active')->label('Visible'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProjectMaterials::route('/'),
            'create' => Pages\CreateProjectMaterial::route('/create'),
            'edit'   => Pages\EditProjectMaterial::route('/{record}/edit'),
        ];
    }
}
