<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Fieldset::make('Additional')
                    ->schema([
                        Forms\Components\TextInput::make('nama_produk')
                            ->required()
                            ->maxLength(50)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation
                                === 'create' ? $set('kode_produk', Str::slug($state)) : null),

                        Forms\Components\TextInput::make('kode_produk')
                            ->maxLength(50)
                            ->disabled()
                            ->required()
                            ->dehydrated()
                            ->unique(Produk::class, 'kode_produk', ignoreRecord: true),

                        // Forms\Components\TextInput::make('nama_produk')
                        // ->required()
                        // ->maxLength(50),

                        Forms\Components\Select::make('kategori_id')
                            ->relationship('kategori', 'nama_kategori')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('deskripsi')
                            ->required()
                            ->maxLength(150),

                        Forms\Components\FileUpload::make('gambar')
                            ->image()
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nama_produk')
                    ->searchable(),

                Tables\Columns\TextColumn::make('kategori.nama_kategori')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('gambar'),

                Tables\Columns\TextColumn::make('deskripsi')
            ])
            ->filters([
                //
                SelectFilter::make('kategori_id')
                    ->label('kategori')
                    ->relationship('kategori', 'nama_kategori')
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
