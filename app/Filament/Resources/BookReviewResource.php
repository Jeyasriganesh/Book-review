<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookReviewResource\Pages;
use App\Models\BookReview;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Exports\BookReviewExporter;


class BookReviewResource extends Resource
{
    protected static ?string $model = BookReview::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Book Management';
    protected static ?string $label = 'Book Review';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('book_title')
                    ->label('Book Title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('author_name')
                    ->label('Author Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rating')
                    ->required()
                    ->numeric() 
                    ->minValue(1)   
                    ->maxValue(5),  
                Forms\Components\DatePicker::make('review_date')
                    ->label('Review Date')
                    ->default(now())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('book_title')
                    ->label('Book Title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('author_name')
                    ->label('Author Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('review_date')
                    ->label('Review Date')
                    ->sortable()
                    ->searchable(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(BookReviewExporter::class)
            ])
            ->filters([
                Filter::make('review_date')
                    ->label('Filter by Date')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('From Date'),
                        Forms\Components\DatePicker::make('to')->label('To Date'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($query) => $query->where('review_date', '>=', $data['from']))
                            ->when($data['to'], fn ($query) => $query->where('review_date', '<=', $data['to']));
                    }),
            ])
            ->defaultSort('review_date', 'desc')
            ->actions([  // Add actions to the rows
                Tables\Actions\EditAction::make(),  // Edit button
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()  // Delete button
                
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookReviews::route('/'),
            'create' => Pages\CreateBookReview::route('/create'),
            'edit' => Pages\EditBookReview::route('/{record}/edit'),
            'view' => Pages\ViewBookReview::route('/{record}'),
        ];
    }
}
