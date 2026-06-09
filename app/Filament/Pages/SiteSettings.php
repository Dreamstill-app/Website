<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use App\Support\Cms\SiteDefaults;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use UnitEnum;

class SiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::query()->firstOrCreate(['id' => 1], SiteDefaults::settings());

        $this->form->fill(array_merge(SiteDefaults::settings(), $settings->only(array_keys(SiteDefaults::settings()))));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Header')->schema([
                    Textarea::make('top_ribbon')->label('Top ribbon')->rows(2)->columnSpanFull(),
                    FileUpload::make('logo_path')->label('Logo')->image()->disk('public')->directory('uploads/site')->columnSpanFull(),
                    TextInput::make('logo_width_px')->label('Logo width (px)')->numeric()->minValue(40)->maxValue(480)->required(),
                    TextInput::make('site_name')->label('Site name')->required(),
                    TextInput::make('site_tagline')->label('Site tagline')->required(),
                    TextInput::make('header_cta_label')->label('Header CTA label')->required(),
                    TextInput::make('header_cta_url')->label('Header CTA URL')->required(),
                ])->columns(2),

                Section::make('Footer')->schema([
                    Textarea::make('footer_cta_text')->label('Footer CTA text')->rows(2)->columnSpanFull(),
                    TextInput::make('footer_cta_button_label')->label('Footer CTA button label')->required(),
                    TextInput::make('footer_cta_button_url')->label('Footer CTA button URL')->required(),
                    Textarea::make('footer_blurb')->label('Footer blurb / land acknowledgement')->rows(4)->columnSpanFull(),
                ])->columns(2),

                Section::make('Mobile CTA')->schema([
                    TextInput::make('mobile_cta_primary_label')->label('Primary button label')->required(),
                    TextInput::make('mobile_cta_primary_url')->label('Primary button URL')->required(),
                    TextInput::make('mobile_cta_secondary_label')->label('Secondary button label')->required(),
                    TextInput::make('mobile_cta_secondary_url')->label('Secondary button URL')->required(),
                ])->columns(2),

                Section::make('Contact & Social')->schema([
                    TextInput::make('contact_email')->label('Contact email')->email(),
                    TextInput::make('contact_phone')->label('Contact phone'),
                    TextInput::make('contact_location')->label('Contact location')->columnSpanFull(),
                    Repeater::make('social_links')
                        ->label('Social links')
                        ->schema([
                            TextInput::make('label')->label('Label')->required(),
                            TextInput::make('url')->label('URL')->required(),
                        ])
                        ->default([])
                        ->addActionLabel('Add social link')
                        ->columnSpanFull(),
                ])->columns(2),

                Section::make('SEO Defaults')->schema([
                    Textarea::make('default_meta_description')->label('Default meta description')->rows(3)->columnSpanFull(),
                    FileUpload::make('default_og_image')->label('Default OG image')->image()->disk('public')->directory('uploads/og')->columnSpanFull(),
                ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save settings')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $state = array_merge(SiteDefaults::settings(), $this->form->getState());

        SiteSetting::query()->updateOrCreate(['id' => 1], $state);

        Notification::make()
            ->title('Site settings saved')
            ->success()
            ->send();
    }
}
