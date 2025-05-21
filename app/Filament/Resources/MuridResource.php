use Filament\Forms;
use Filament\Tables;
use App\Models\Murid;

class MuridResource extends Resource
{
    protected static ?string $model = Murid::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Data Murid';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')->required(),
            Forms\Components\TextInput::make('nis')->required()->unique(),
            Forms\Components\TextInput::make('kelas')->required(),
            Forms\Components\Select::make('jenis_kelamin')
                ->options([
                    'Laki-laki' => 'Laki-laki',
                    'Perempuan' => 'Perempuan',
                ])->required(),
            Forms\Components\Textarea::make('alamat'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('nama')->searchable(),
            Tables\Columns\TextColumn::make('nis')->searchable(),
            Tables\Columns\TextColumn::make('kelas'),
            Tables\Columns\TextColumn::make('jenis_kelamin'),
            Tables\Columns\TextColumn::make('alamat')->limit(30),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMurids::route('/'),
            'create' => Pages\CreateMurid::route('/create'),
            'edit' => Pages\EditMurid::route('/{record}/edit'),
        ];
    }
}
