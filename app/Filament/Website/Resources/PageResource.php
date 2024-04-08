<?php

namespace App\Filament\Website\Resources;

use Filament\Forms;
use App\Models\Page;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Placeholder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Website\Resources\PageResource\Pages;
use Illuminate\Database\Eloquent\Builder as LaravelBuilder;
use App\Filament\Website\Resources\PageResource\RelationManagers;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->id('page-container')
                    ->schema([
                        Section::make([
                            TextInput::make('title')
                                ->required()
                                ->columnSpan('2'),
                            TextInput::make('slug')
                                ->columnSpan('2')
                                ->disabled(),
                            Section::make('Page Content')
                                ->schema([
                                    Builder::make('content')
                                        ->label('')
                                        ->blocks([
                                            Builder\Block::make('heading')
                                                ->schema([
                                                    TextInput::make('content')
                                                        ->label('Heading')
                                                        ->required()
                                                        ->columnSpan(2),
                                                    Select::make('level')
                                                        ->options([
                                                            'h1' => 'Heading 1',
                                                            'h2' => 'Heading 2',
                                                            'h3' => 'Heading 3',
                                                            'h4' => 'Heading 4',
                                                            'h5' => 'Heading 5',
                                                            'h6' => 'Heading 6',
                                                        ])
                                                        ->selectablePlaceholder(false)
                                                        ->default('h2')
                                                        ->required(),
                                                    Select::make('alignment')
                                                        ->options([
                                                            'left' => 'Left',
                                                            'center' => 'Center',
                                                            'right' => 'Right',
                                                        ])
                                                        ->selectablePlaceholder(false)
                                                        ->default('left')
                                                        ->required(),
                                                ])
                                                ->columns(2)
                                                ->icon('heroicon-o-hashtag')
                                                ->columns(2),

                                            Builder\Block::make('form')
                                                // ->label('Form')
                                                ->schema([
                                                    TextInput::make('id')
                                                        ->disabled()
                                                        ->hidden(),
                                                    Placeholder::make('')
                                                        // ->content('Select the type of data you would like to start gathering.')
                                                        ->content(function($state) {
                                                            $formId = $state['id'];
                                                            // http://pages.test/builder/submissions?tableSearch=1377
                                                            $url = url('/') . '/builder/submissions?tableSearch=' . $formId;
                                                            return new HtmlString('<a href="'.$url.'">View all submissions for this form <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="inline w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                                              </svg>
                                                              </a>');
                                                        }),
                                                    Repeater::make('form_fields')
                                                        ->label('Form Fields')
                                                        ->simple(
                                                            Select::make('type')
                                                                ->options([
                                                                    'email' => 'Email',
                                                                    'phone' => 'Phone Number',
                                                                    'full_name' => 'Full Name',
                                                                    'feedback' => 'Feedback',
                                                                ])
                                                                ->default('email')
                                                                ->selectablePlaceholder(false)
                                                                ->required()
                                                                ->distinct(),
                                                        )
                                                        ->defaultItems(0)
                                                        ->minItems(1)
                                                        ->maxItems(4),
                                                    // TextInput::make('content')
                                                    //     ->label('Heading')
                                                    //     ->required(),
                                                ])
                                                ->icon('heroicon-o-inbox-arrow-down')
                                                ->maxItems(1),

                                            Builder\Block::make('content')
                                                ->schema([
                                                    RichEditor::make('content')
                                                        ->required()
                                                        ->disableToolbarButtons([
                                                            'attachFiles',
                                                        ])
                                                ])
                                                ->maxItems(3)
                                                ->icon('heroicon-o-chat-bubble-bottom-center-text'),

                                            Builder\Block::make('image')
                                                ->schema([
                                                    FileUpload::make('image')
                                                        ->label('Image')
                                                        ->image()
                                                        ->required()
                                                        ->maxSize(3000),
                                                    TextInput::make('alt')
                                                        ->label('Alt text')
                                                        ->required(),
                                                ])
                                                ->maxItems(3)
                                                ->icon('heroicon-o-photo'),

                                        ])
                                        ->addActionLabel('Add a new section')
                                        ->collapsible()
                                ])
                                ->compact()
                                ->columnSpan(2)
                        ])
                        ->id('page-content')
                        ->columnSpan(8),

                        Section::make([
                            Section::make('Status')
                                ->schema([
                                    Select::make('status')
                                        ->options([
                                            'draft' => 'Draft',
                                            // 'reviewing' => 'Reviewing',
                                            'published' => 'Published',
                                        ])
                                        ->default('draft')
                                        ->selectablePlaceholder(false)
                                ])
                                ->compact()
                        ])
                        ->columnSpan(4)
                        ->id('page-status')
                    ])
                ->compact()
                ->columns(12)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
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
            ->paginated(false);
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): LaravelBuilder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->user()->id);
    }
}
