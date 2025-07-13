<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerResource\RelationManagers;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ToggleButtons::make('is_active')
                    ->label('Active (loses focus)')
                    ->live()
                    ->boolean(),
                TextInput::make('name')
                    ->label('Name (works)')
                    ->live()
                    ->required(),
                Radio::make('gender')
                    ->label('Gender (loses focus)')
                    ->live()
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ]),
                Placeholder::make('is_active_info')
                    ->label('Active Indicator')
                    ->content(fn (Get $get) => new HtmlString('<span class="text-green-500">' . ($get('is_active') ? 'Active' : 'Inactive') . '</span>')),
                Placeholder::make('name_info')
                    ->label('Name')
                    ->content(fn (Get $get) => new HtmlString('<span class="text-green-500">' . $get('name') . '</span>')),
                Placeholder::make('gender_info')
                    ->label('Gender')
                    ->content(fn (Get $get) => new HtmlString('<span class="text-green-500">' . $get('gender') . '</span>')),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
