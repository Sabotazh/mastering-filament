<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->unique()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                    if ($operation !== 'create') {
                                        return;
                                    }

                                    $set('slug', Str::slug($state));
                                }),

                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->unique(),

                            Forms\Components\TextInput::make('url')
                                ->required()
                                ->label('Website URL')
                                ->unique()
                                ->columnSpanFull(),

                            Forms\Components\MarkdownEditor::make('description')
                                ->columnSpanFull()
                        ])->columns(2)
                    ]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->schema([
                                Forms\Components\Toggle::make('is_visible')
                                    ->label('Visibility')
                                    ->helperText('Enable or disable brand visibility')
                                    ->default(true),
                            ]),

                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Color')
                                    ->schema([
                                        Forms\Components\ColorPicker::make('primary_hex')
                                            ->label('Primary color'),
                                    ])
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('url')
                    ->label('Website URL')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ColorColumn::make('primary_hex')
                    ->label('Primary color'),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Visibility')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ]
//                , position: Tables\Enums\ActionsPosition::BeforeColumns
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProductsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
