<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('title')
                    ->unique()
                    ->required()
                    ->maxLength(255),


                Components\FileUpload::make('thumbnail')
                    ->image()
                    ->directory('projects')
                    ->maxSize(2048)
                    ->required(),

                Components\DatePicker::make('start_date')
                    ->required(),

                Components\DatePicker::make('end_date'),

                Components\TextInput::make('website_link')
                    ->maxLength(255),

                Components\TextInput::make('github_link')
                    ->maxLength(255),


                Components\Textarea::make('description')
                    ->rows(10)
                    ->cols(20),

                Components\Radio::make('is_featured')
                    ->label('Is Featurued?')
                    ->boolean()->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('start_date'),
                Tables\Columns\TextColumn::make('end_date'),
                Tables\Columns\TextColumn::make('website_link'),
                Tables\Columns\TextColumn::make('github_link'),
                Tables\Columns\TextColumn::make('description')->limit(10),
                Tables\Columns\TextColumn::make('slug'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
