<?php

namespace App\Filament\Website\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\FormSubmission;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Website\Resources\SubmissionsResource\Pages;
use App\Filament\Website\Resources\SubmissionsResource\RelationManagers;

class SubmissionsResource extends Resource
{
    protected static ?string $model = FormSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('full_name')
                    ->label('Full Name')
                    ->columnSpan(2)
                    ->disabled(),
                TextInput::make('email')
                    ->columnSpan(2)
                    ->disabled(),
                TextInput::make('phone')
                    ->columnSpan(2)
                    ->disabled(),
                Textarea::make('textarea')
                    ->label('feedback')
                    ->columnSpan(2)
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('form_id')
                    ->sortable(['full_name'])
                    ->searchable(),
                TextColumn::make('full_name')
                    ->label('Full Name')
                    ->sortable(['full_name'])
                    ->searchable(),
                TextColumn::make('email')
                    ->limit(35)
                    ->sortable(['email']),
                TextColumn::make('phone')
                    ->limit(35)
                    ->sortable(['phone']),
                TextColumn::make('textarea')
                    ->label('Feedback')
                    ->limit(35)
                    ->sortable(['textarea']),
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
            ])
            ->defaultSort('created_at', 'desc');;
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
            'index' => Pages\ListSubmissions::route('/'),
            'create' => Pages\CreateSubmissions::route('/create'),
            'edit' => Pages\EditSubmissions::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('page_owner_id', auth()->user()->id);
    }
}
