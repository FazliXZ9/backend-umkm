<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
// use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
// use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                Select::make('category')
                    ->options([
                        'Steam' => 'Steam',
                        'Sablon' => 'Sablon',
                        'Kuliner' => 'Kuliner',
                        'Konter' => 'Konter',
                    ])->required(),
                Textarea::make('description')->required(),
                FileUpload::make('image_path')
                    ->image()
                    ->directory('services')
                    ->disk('public') // <--- Tambahkan baris ini
                    ->visibility('public') // <--- Tambahkan baris ini (opsional tapi bagus)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Menampilkan Gambar Kecil
                ImageColumn::make('image_path')
                    ->label('Foto')
                    ->disk('public'), // Pastikan disk sesuai setting upload

                // Menampilkan Judul
                TextColumn::make('title')
                    ->label('Nama Layanan')
                    ->sortable()
                    ->searchable(),

                // Menampilkan Kategori
                TextColumn::make('category')
                    ->label('Kategori')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // Tambahkan tombol delete jika perlu
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
