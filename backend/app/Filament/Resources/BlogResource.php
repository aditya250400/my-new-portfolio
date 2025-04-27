<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Components\Textarea::make('description')
                    ->rows(10)
                    ->cols(20),

                Components\FileUpload::make('thumbnail')
                    ->image()
                    ->directory('blogs')
                    ->maxSize(3072)
                    ->required(),

                Components\RichEditor::make('content')
                    ->fileAttachmentsDirectory('blogs'),

                Components\Select::make('blog_category_id')
                    ->relationship('blogCategory', 'name')
                    ->searchable()
                    ->preload()->required(),

                Forms\Components\Radio::make('is_show')
                    ->label('Is Show?')
                    ->boolean()->required(),




            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail'),
                IconColumn::make('is_show')
                    ->boolean(),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
