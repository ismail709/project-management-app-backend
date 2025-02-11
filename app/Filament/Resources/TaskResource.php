<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('parent_task_id')
                    ->relationship('parentTask', 'task_title')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('sprint_id')
                    ->relationship('sprint', 'sprint_name')
                    ->searchable()
                    ->required()
                    ->preload(),
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'project_name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('task_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('task_description')
                    ->columnSpanFull(),
                Forms\Components\Select::make('task_type_id')
                    ->relationship('taskType', 'task_type_name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('task_priority')
                    ->options([
                        'low' => 'Low',
                        'regular' => 'Regular',
                        'high' => 'High',
                        'critical' => 'Critical',
                    ])
                    ->default('regular'),
                Forms\Components\Select::make('task_status')
                    ->options([
                        'todo' => 'To Do',
                        'in_progress' => 'In Progress',
                        'done' => 'Done',
                    ])
                    ->default('todo'),
                Forms\Components\TextInput::make('estimated_days')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('actual_days')
                    ->numeric()
                    ->default(null),
                Forms\Components\Select::make('created_by')
                    ->relationship('createdBy', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parentTask.task_title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sprint.sprint_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.project_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('task_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('taskType.task_type_name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('task_priority'),
                Tables\Columns\TextColumn::make('task_status')
                    ->badge()
                    ->color(fn ($record) => match ($record->task_status) {
                        'todo' => 'gray',
                        'in_progress' => 'primary',
                        'done' => 'success',
                    }),
                Tables\Columns\TextColumn::make('estimated_days')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('actual_days')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('createdBy.name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
