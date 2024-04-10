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
use Filament\Tables\Actions\Action;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Pages';

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
                                                            
                                                            if($formId) {
                                                                $url = url('/builder/submissions?tableSearch=' . $formId);
                                                                return new HtmlString('
                                                                    <div>
                                                                        <p class="text-sm text-gray-600">
                                                                            Form ID: <b>'.$formId.'</b>
                                                                        </p>
                                                                        <a href="'.$url.'">View all submissions for this form <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="inline w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg></a>
                                                                    </div>
                                                                ');
                                                            }

                                                            return '';
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
                                                        ->imageEditor()
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
                                    Placeholder::make('')
                                        ->content(function($state) {
                                            if(! isset($state['random_id']) && ! isset($state['slug'])) {
                                                return "View page here after it's created";
                                            }

                                            $url = route('page', [$state['random_id'], $state['slug']]);
                                            // $url = url('/') . '/builder/submissions?tableSearch=' . $formId;
                                            return new HtmlString('<a href="'.$url.'" target="_blank">View Page <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="inline w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg></a>');
                                        }),
                                    Select::make('status')
                                        ->options([
                                            'draft' => 'Draft',
                                            // 'reviewing' => 'Reviewing',
                                            'published' => 'Published',
                                        ])
                                        ->default('draft')
                                        ->selectablePlaceholder(false),
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
                TextColumn::make('title'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'reviewing' => 'warning',
                        'published' => 'success',
                        'rejected' => 'danger',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('View')
                    ->url(fn (Page $record): string => route('page', [$record['random_id'], $record['slug']]))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-top-right-on-square')
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

    public static function canCreate(): bool
    {
        return ! userHasReachedMaxPages();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
            // 'settings' => Pages\Settings::route('/settings'),
        ];
    }

    public static function getEloquentQuery(): LaravelBuilder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->user()->id);
    }

    public static function canAccess(): bool
    {
        $hasAccess = hasAccess();

        if(! $hasAccess) {
            redirect("/billing?message=You don't have access. Start your subscription to create your pages.");
        }

        return true;
    }
}
