@props([
    'actions' => false,
    'actionsPosition' => null,
    'columns',
    'extraHeadingColumn' => false,
    'heading',
    'isGroupsOnly' => false,
    'isSelectionEnabled' => false,
    'placeholderColumns' => true,
    'query',
    'strong' => false,
])

@php
    use Filament\Tables\Actions\Position as ActionsPosition;
@endphp

<x-filament-tables::row {{ $attributes->class([
    'bg-gray-500/5' => $strong,
]) }}>
    @if ($placeholderColumns && $actions && in_array($actionsPosition, [ActionsPosition::BeforeCells, ActionsPosition::BeforeColumns]))
        <td></td>
    @endif

    @if ($placeholderColumns && $isSelectionEnabled)
        <td></td>
    @endif

    @if ($placeholderColumns && $actions && $actionsPosition === ActionsPosition::BeforeColumns)
        <td></td>
    @endif

    @if ($extraHeadingColumn || $isGroupsOnly)
        <td @class([
            'align-top px-4 py-3 font-medium',
            'text-sm' => ! $strong,
            'text-base' => $strong,
        ])>
            {{ $heading }}
        </td>
    @else
        @php
            $headingColumnSpan = 1;

            foreach ($columns as $index => $column) {
                if ($index === array_key_first($columns)) {
                    continue;
                }

                if ($column->hasSummary()) {
                    break;
                }

                $headingColumnSpan++;
            }
        @endphp
    @endif

    @foreach ($columns as $column)
        @if (($loop->first || $extraHeadingColumn || $isGroupsOnly || ($loop->iteration > $headingColumnSpan)) && ($placeholderColumns || $column->hasSummary()))
            <td
                @if ($loop->first && (! $extraHeadingColumn) && (! $isGroupsOnly) && ($headingColumnSpan > 1))
                    colspan="{{ $headingColumnSpan }}"
                @endif
                class="-space-y-3 align-top"
            >
                @if ($loop->first && (! $extraHeadingColumn) && (! $isGroupsOnly))
                    <div @class([
                        'px-4 py-3 font-medium',
                        'text-sm' => ! $strong,
                        'text-base' => $strong,
                    ])>
                        {{ $heading }}
                    </div>
                @elseif ((! $placeholderColumns) || $column->hasSummary())
                    @foreach ($column->getSummary($query) as $summary)
                        {{ $summary }}
                    @endforeach
                @endif
            </td>
        @endif
    @endforeach

    @if ($placeholderColumns && $actions && $actionsPosition === ActionsPosition::AfterCells)
        <td></td>
    @endif
</x-filament-tables::row>