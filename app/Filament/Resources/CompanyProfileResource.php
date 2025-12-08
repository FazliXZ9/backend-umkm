<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyProfileResource\Pages;
use App\Models\CompanyProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload; // Import ini
use Filament\Forms\Components\Textarea;   // Import ini
use Filament\Tables\Columns\ImageColumn;  // Import ini
use Filament\Tables\Columns\TextColumn;   // Import ini

class CompanyProfileResource extends Resource
{
    protected static ?string $model = CompanyProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office'; // Ikon gedung (opsional)
    protected static ?string $navigationLabel = 'Profil UMKM';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Input Foto
                FileUpload::make('image_path')
                    ->label('Foto UMKM')
                    ->image()
                    ->disk('public') // Wajib: agar bisa diakses frontend
                    ->directory('company') // Disimpan di folder storage/app/public/company
                    ->required()
                    ->columnSpanFull(), // Agar lebar penuh

                // Input Deskripsi
                Textarea::make('about_description')
                    ->label('Deskripsi About Us')
                    ->required()
                    ->rows(10) // Agar kotaknya tinggi
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Menampilkan Thumbnail Foto
                ImageColumn::make('image_path')
                    ->label('Foto')
                    ->disk('public'),

                // Menampilkan Potongan Deskripsi
                TextColumn::make('about_description')
                    ->label('Deskripsi')
                    ->limit(50) // Hanya tampilkan 50 huruf pertama
                    ->searchable(),

                TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime(),
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

    // ... sisa method lainnya biarkan default

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanyProfiles::route('/'),
            'create' => Pages\CreateCompanyProfile::route('/create'),
            'edit' => Pages\EditCompanyProfile::route('/{record}/edit'),
        ];
    }
}
