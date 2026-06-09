<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    // ────────────────────────────────────────────────────
    //  Reusable helpers
    // ────────────────────────────────────────────────────

    private static function richEditor(string $field, string $label): RichEditor
    {
        return RichEditor::make($field)
            ->label($label)
            ->toolbarButtons([
                'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock',
                'h2', 'h3', 'italic', 'link', 'orderedList', 'redo',
                'strike', 'table', 'underline', 'undo',
            ])
            ->fileAttachmentsDisk('public')
            ->fileAttachmentsDirectory('uploads/content')
            ->columnSpanFull();
    }

    private static function imageUpload(string $field, string $label): FileUpload
    {
        return FileUpload::make($field)
            ->label($label)
            ->image()
            ->imageEditor()
            ->disk('public')
            ->directory('uploads/sections')
            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
            ->columnSpanFull();
    }

    private static function buttonRepeater(string $field = 'data.buttons'): Repeater
    {
        return Repeater::make($field)
            ->label('Buttons')
            ->schema([
                Grid::make(3)->schema([
                    TextInput::make('label')->label('Label')->required(),
                    TextInput::make('url')->label('URL')->required(),
                    Select::make('style')->label('Style')->options([
                        '' => 'Default', 'lime' => 'Lime', 'coral' => 'Coral',
                        'light' => 'Light', 'outline' => 'Outline',
                    ])->default(''),
                ]),
            ])
            ->addActionLabel('Add button')
            ->collapsible()
            ->columnSpanFull();
    }

    private static function sectionTypeOptions(): array
    {
        return [
            'hero'        => '🏠 Hero (home-style with slider)',
            'page_hero'   => '📄 Page Hero (inner page header)',
            'mission'     => '🎯 Mission / Focus Statement',
            'stats'       => '📊 Stats / Impact Grid',
            'cards'       => '🃏 Cards Grid',
            'text_card'   => '📝 Text Card (heading + rich text)',
            'timeline'    => '📅 Timeline',
            'press'       => '📰 Press & Media Grid',
            'logo_strip'  => '🏢 Logo Strip / Partners / Tags',
            'newsletter'  => '📧 Newsletter Signup',
            'contact_cta' => '📞 Contact CTA',
            'image_text'  => '🖼️ Image + Text',
            'rich_text'   => '✏️ Free Rich Text',
            'raw_blade'   => '⚙️ Raw Blade / HTML (advanced)',
        ];
    }

    // ── section-specific field groups ─────────────────

    private static function heroFields(): array
    {
        return [
            Grid::make(2)->schema([
                TextInput::make('data.eyebrow')->label('Eyebrow'),
                TextInput::make('data.headline')->label('Headline'),
            ]),
            Textarea::make('data.lede')->label('Lede / Subtext')->rows(3)->columnSpanFull(),
            TextInput::make('data.hero_note')->label('Hero note (below buttons)')->columnSpanFull(),
            static::buttonRepeater('data.buttons'),
            Repeater::make('data.slides')->label('Slider Slides')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('heading')->label('Slide heading')->required(),
                        TextInput::make('text')->label('Slide subtext'),
                    ]),
                    static::imageUpload('image', 'Slide image'),
                    TextInput::make('image_alt')->label('Image alt text')->columnSpanFull(),
                ])
                ->addActionLabel('Add slide')->collapsible()
                ->itemLabel(fn (?array $state): ?string => $state['heading'] ?? 'Slide')
                ->columnSpanFull(),
        ];
    }

    private static function pageHeroFields(): array
    {
        return [
            Toggle::make('data.slider_style')->label('Use multi-slide style (like About page)')->live()->columnSpanFull(),
            TextInput::make('data.eyebrow')->label('Eyebrow')
                ->hidden(fn ($get) => (bool) $get('data.slider_style'))->columnSpanFull(),
            TextInput::make('data.heading')->label('Heading')
                ->hidden(fn ($get) => (bool) $get('data.slider_style'))->columnSpanFull(),
            Textarea::make('data.text')->label('Text')->rows(3)
                ->hidden(fn ($get) => (bool) $get('data.slider_style'))->columnSpanFull(),
            TextInput::make('data.badge')->label('Badge text (accent bubble)')
                ->hidden(fn ($get) => (bool) $get('data.slider_style'))->columnSpanFull(),
            static::imageUpload('data.image', 'Image')
                ->hidden(fn ($get) => (bool) $get('data.slider_style')),
            TextInput::make('data.image_alt')->label('Image alt text')
                ->hidden(fn ($get) => (bool) $get('data.slider_style'))->columnSpanFull(),
            static::buttonRepeater('data.buttons'),
            Repeater::make('data.slides')->label('Slides')
                ->hidden(fn ($get) => !(bool) $get('data.slider_style'))
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('eyebrow')->label('Eyebrow'),
                        TextInput::make('heading')->label('Heading')->required(),
                    ]),
                    Textarea::make('text')->label('Text')->rows(2)->columnSpanFull(),
                    static::imageUpload('image', 'Slide image'),
                    TextInput::make('image_alt')->label('Image alt text')->columnSpanFull(),
                ])
                ->addActionLabel('Add slide')->collapsible()
                ->itemLabel(fn (?array $state): ?string => $state['heading'] ?? 'Slide')
                ->columnSpanFull(),
        ];
    }

    private static function missionFields(): array
    {
        return [
            Grid::make(2)->schema([
                TextInput::make('data.eyebrow')->label('Eyebrow'),
                TextInput::make('data.heading')->label('Heading'),
            ]),
            Textarea::make('data.text')->label('Text')->rows(3)->columnSpanFull(),
        ];
    }

    private static function statsFields(): array
    {
        return [
            Grid::make(2)->schema([
                TextInput::make('data.heading')->label('Section heading'),
                Select::make('data.columns')->label('Columns')
                    ->options(['2' => '2 cols', '3' => '3 cols', '4' => '4 cols'])->default('4'),
            ]),
            Textarea::make('data.subtext')->label('Subtext')->rows(2)->columnSpanFull(),
            Repeater::make('data.items')->label('Stats')
                ->schema([Grid::make(2)->schema([
                    TextInput::make('number')->label('Number')->placeholder('40+')->required(),
                    TextInput::make('label')->label('Label')->placeholder('events hosted')->required(),
                ])])
                ->addActionLabel('Add stat')->collapsible()->columnSpanFull(),
            Textarea::make('data.source_note')->label('Source note')->rows(2)->columnSpanFull(),
        ];
    }

    private static function cardsFields(): array
    {
        return [
            Grid::make(2)->schema([
                TextInput::make('data.heading')->label('Section heading'),
                Select::make('data.columns')->label('Columns')
                    ->options(['2' => '2 cols', '3' => '3 cols', '4' => '4 cols'])->default('2'),
            ]),
            Textarea::make('data.subtext')->label('Subtext')->rows(2)->columnSpanFull(),
            TextInput::make('data.card_class')->label('Card CSS class (optional)')->placeholder('solution-card')->columnSpanFull(),
            Repeater::make('data.items')->label('Cards')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('eyebrow')->label('Eyebrow'),
                        TextInput::make('heading')->label('Heading')->required(),
                    ]),
                    static::imageUpload('image', 'Card image (optional)'),
                    TextInput::make('image_alt')->label('Image alt text')->columnSpanFull(),
                    static::richEditor('text', 'Card text'),
                    Grid::make(2)->schema([
                        TextInput::make('link_label')->label('Link label'),
                        TextInput::make('link_url')->label('Link URL'),
                    ]),
                ])
                ->addActionLabel('Add card')->collapsible()
                ->itemLabel(fn (?array $state): ?string => $state['heading'] ?? 'Card')
                ->columnSpanFull(),
        ];
    }

    private static function textCardFields(): array
    {
        return [
            TextInput::make('data.heading')->label('Section heading')->columnSpanFull(),
            static::richEditor('data.content', 'Content'),
        ];
    }

    private static function timelineFields(): array
    {
        return [
            Grid::make(2)->schema([
                TextInput::make('data.heading')->label('Section heading'),
                TextInput::make('data.subtext')->label('Subtext'),
            ]),
            Repeater::make('data.items')->label('Timeline items')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('period')->label('Period / Date')->required(),
                        TextInput::make('title')->label('Title'),
                    ]),
                    static::richEditor('text', 'Description'),
                    TextInput::make('outcome')->label('Outcome (→ result)')->columnSpanFull(),
                ])
                ->addActionLabel('Add item')->collapsible()
                ->itemLabel(fn (?array $state): ?string => ($state['period'] ?? '') . (isset($state['title']) ? ' — '.$state['title'] : ''))
                ->columnSpanFull(),
        ];
    }

    private static function pressFields(): array
    {
        return [
            Grid::make(2)->schema([
                TextInput::make('data.heading')->label('Section heading'),
                TextInput::make('data.subtext')->label('Subtext'),
            ]),
            Textarea::make('data.items_json')->label('Press items JSON')
                ->rows(12)
                ->helperText('Temporary stability mode: edit press items as JSON array objects with eyebrow, heading, image, image_alt, text, link_label, and link_url keys.')
                ->formatStateUsing(function ($state, $record, $get) {
                    $items = $get('data.items');

                    if (is_array($items)) {
                        return json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                    }

                    return is_string($state) ? $state : '[]';
                })
                ->dehydrateStateUsing(function ($state) {
                    $decoded = json_decode($state ?: '[]', true);

                    return json_last_error() === JSON_ERROR_NONE && is_array($decoded)
                        ? json_encode(array_values($decoded))
                        : '[]';
                })
                ->columnSpanFull(),
        ];
    }

    private static function logoStripFields(): array
    {
        return [
            Grid::make(2)->schema([
                TextInput::make('data.heading')->label('Section heading'),
                TextInput::make('data.subtext')->label('Subtext'),
            ]),
            Repeater::make('data.tags')->label('Audience tags')
                ->schema([TextInput::make('label')->label('Tag')->required()])
                ->addActionLabel('Add tag')->collapsible()->columnSpanFull(),
            TextInput::make('data.partners_heading')->label('Partners sub-heading (optional)')->columnSpanFull(),
            Repeater::make('data.partners')->label('Partners / logos')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('label')->label('Name / alt text')->required(),
                        TextInput::make('url')->label('Link URL (optional)'),
                    ]),
                    static::imageUpload('image', 'Logo image (leave blank for text)'),
                ])
                ->addActionLabel('Add partner')->collapsible()
                ->itemLabel(fn (?array $state): ?string => $state['label'] ?? 'Partner')
                ->columnSpanFull(),
        ];
    }

    private static function newsletterFields(): array
    {
        return [
            Grid::make(2)->schema([
                TextInput::make('data.eyebrow')->label('Eyebrow')->placeholder('Stay in the loop'),
                TextInput::make('data.heading')->label('Heading')->placeholder('Join our mailing list'),
            ]),
            Textarea::make('data.text')->label('Text')->rows(2)->columnSpanFull(),
            Grid::make(2)->schema([
                TextInput::make('data.placeholder')->label('Input placeholder')->placeholder('your@email.com'),
                TextInput::make('data.button_label')->label('Button label')->placeholder('Subscribe'),
            ]),
        ];
    }

    private static function contactCtaFields(): array
    {
        return [
            Grid::make(2)->schema([
                TextInput::make('data.eyebrow')->label('Eyebrow'),
                TextInput::make('data.heading')->label('Heading'),
            ]),
            Textarea::make('data.text')->label('Text')->rows(3)->columnSpanFull(),
            static::buttonRepeater('data.buttons'),
            Repeater::make('data.contact_items')->label('Contact details')
                ->schema([Grid::make(2)->schema([
                    TextInput::make('label')->label('Display label')->required(),
                    TextInput::make('url')->label('Link (tel: / mailto:)'),
                ])])
                ->addActionLabel('Add contact item')->collapsible()->columnSpanFull(),
        ];
    }

    private static function imageTextFields(): array
    {
        return [
            Grid::make(2)->schema([
                TextInput::make('data.eyebrow')->label('Eyebrow'),
                Select::make('data.image_position')->label('Image position')
                    ->options(['left' => 'Left', 'right' => 'Right'])->default('right'),
            ]),
            TextInput::make('data.heading')->label('Heading')->columnSpanFull(),
            static::richEditor('data.content', 'Content'),
            static::imageUpload('data.image', 'Image'),
            TextInput::make('data.image_alt')->label('Image alt text')->columnSpanFull(),
            static::buttonRepeater('data.buttons'),
        ];
    }

    private static function richTextFields(): array
    {
        return [static::richEditor('data.content', 'Content')];
    }

    private static function rawBladeFields(): array
    {
        return [
            Textarea::make('data.markup')->label('Raw Blade / HTML')->rows(20)->columnSpanFull(),
        ];
    }

    // ────────────────────────────────────────────────────
    //  Main schema
    // ────────────────────────────────────────────────────

    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(1)->components([

            Section::make('Page Details')->schema([
                Grid::make(2)->schema([
                    TextInput::make('title')->required()->maxLength(255)->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, callable $set) =>
                            $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true)->prefix('/'),
                    TextInput::make('nav_label')->label('Navigation Label')->maxLength(255),
                    Select::make('status')->options(['draft' => 'Draft', 'published' => 'Published'])->default('draft')->required(),
                ]),
                Grid::make(3)->schema([
                    Toggle::make('show_in_nav')->label('Show in Navigation')->default(false),
                    Toggle::make('is_homepage')->label('Set as Homepage')->default(false),
                ]),
            ]),

            Section::make('Page Sections')
                ->description('Add, reorder, and edit every section on this page. Choose a section type to reveal its specific fields.')
                ->schema([
                    Repeater::make('sections')
                        ->label(false)
                        ->schema([

                            Hidden::make('id'),
                            Hidden::make('sort_order'),
                            Grid::make(2)->schema([
                                TextInput::make('name')->label('Section label (internal)')->placeholder('e.g. Hero, Mission, Stats…')->maxLength(255),
                                Select::make('type')
                                    ->label('Section type')
                                    ->options(static::sectionTypeOptions())
                                    ->default('rich_text')
                                    ->required()
                                    ->live(),
                            ]),

                            Section::make('Hero')->schema(static::heroFields())
                                ->hidden(fn ($get) => $get('type') !== 'hero')->compact(),

                            Section::make('Page Hero')->schema(static::pageHeroFields())
                                ->hidden(fn ($get) => $get('type') !== 'page_hero')->compact(),

                            Section::make('Mission')->schema(static::missionFields())
                                ->hidden(fn ($get) => $get('type') !== 'mission')->compact(),

                            Section::make('Stats / Impact')->schema(static::statsFields())
                                ->hidden(fn ($get) => $get('type') !== 'stats')->compact(),

                            Section::make('Cards Grid')->schema(static::cardsFields())
                                ->hidden(fn ($get) => $get('type') !== 'cards')->compact(),

                            Section::make('Text Card')->schema(static::textCardFields())
                                ->hidden(fn ($get) => $get('type') !== 'text_card')->compact(),

                            Section::make('Timeline')->schema(static::timelineFields())
                                ->hidden(fn ($get) => $get('type') !== 'timeline')->compact(),

                            Section::make('Press & Media')->schema(static::pressFields())
                                ->hidden(fn ($get) => $get('type') !== 'press')->compact(),

                            Section::make('Logo Strip / Partners / Tags')->schema(static::logoStripFields())
                                ->hidden(fn ($get) => $get('type') !== 'logo_strip')->compact(),

                            Section::make('Newsletter')->schema(static::newsletterFields())
                                ->hidden(fn ($get) => $get('type') !== 'newsletter')->compact(),

                            Section::make('Contact CTA')->schema(static::contactCtaFields())
                                ->hidden(fn ($get) => $get('type') !== 'contact_cta')->compact(),

                            Section::make('Image + Text')->schema(static::imageTextFields())
                                ->hidden(fn ($get) => $get('type') !== 'image_text')->compact(),

                            Section::make('Rich Text')->schema(static::richTextFields())
                                ->hidden(fn ($get) => $get('type') !== 'rich_text')->compact(),

                            Section::make('Raw Blade / HTML')->schema(static::rawBladeFields())
                                ->hidden(fn ($get) => $get('type') !== 'raw_blade')->compact(),

                        ])
                        ->orderColumn('sort_order')
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (?array $state): string =>
                            ($state['name'] ?? '') ?: (static::sectionTypeOptions()[$state['type'] ?? ''] ?? 'Section'))
                        ->addActionLabel('Add section')
                        ->columnSpanFull(),
                ]),

            Section::make('SEO')->collapsed()->schema([
                TextInput::make('meta_title')->label('Meta Title')->maxLength(255),
                Textarea::make('meta_description')->label('Meta Description')->rows(3)->maxLength(500),
                FileUpload::make('og_image')->label('OG Image')->image()->imageEditor()->disk('public')->directory('uploads/og'),
            ]),

        ]);
    }
}

