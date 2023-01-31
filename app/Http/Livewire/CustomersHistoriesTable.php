<?php

namespace App\Http\Livewire;

use App\Models\Platform;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Components\TableComponent;
use App\Http\Livewire\Traits\WithPerPagePagination;
use Livewire\Component;

class CustomersHistoriesTable extends Component
{
    use WithPagination;
    use WithCachedRows;
    use WithPerPagePagination;
    use WithSorting;


    public $allPlatforms;
    public array $allPlatformIds = [];


    public $filters = [
        'search' => '',
        'platforms' => [],
        'statuses' => [],
        'dateStart' => '',
        'dateEnd' => '',
    ];

    protected $listeners = [
        'platformSelected'
    ];

    public function mount()
    {
        $this->init();
    }

    public function init()
    {
        $this->allPlatforms = Platform::get();
        $this->allPlatformIds = $this->allPlatforms->pluck('id')->toArray();
    }

    public function getRowsQueryProperty()
    {
        $query =
            DB::table('customers_histories as ch')
            ->select(DB::raw('SUM(al.active_listing) as total_active_listing,
                ch.customer_id,
                (SELECT customer_statuses.name FROM customer_statuses
                    JOIN customers_histories ON
                        customers_histories.customer_status_id = customer_statuses.id
                    WHERE customers_histories.id = max(ch.id)
                    ORDER BY customers_histories.id DESC LIMIT 1)
                    as statusName'))
            ->join('active_listings as al', 'ch.id', '=', 'al.customer_history_id')
            ->join('customer_statuses as cs', 'ch.customer_status_id', '=', 'cs.id')
            ->join('platforms as p', 'al.platform_id', '=', 'p.id')
            ->groupBy('ch.customer_id')

            ->when($this->filters['platforms'], function ($query, $platform) {
                if (collect($platform)->isNotEmpty()) {
                    $query->whereIn('p.id', $platform);
                } else {
                    $query->whereIn('p.id', $this->allPlatformIds);
                }
            })

            ->when($this->filters['statuses'], function ($query, $status) {
                $query->whereIn('ch.customer_status_id', $status);
            })
            ->when($this->filters['dateStart'], function ($query, $date) {
                $query->where('al.date', '>=', $date);
            })
            ->when($this->filters['dateEnd'], function ($query, $date) {
                $query->where('al.date', '<=', $date);
            });

        $this->applySorting($query);

        if (empty($this->sorts)) {
            return $query->orderBy('ch.customer_id', 'desc');
        }

        return $query;
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function render()
    {
        return view('livewire.customers-histories-table', [
            'customersHistories' => $this->rows,
        ]);
    }

    public function platformSelected($value)
    {


        $this->filters['platforms'] = collect($value)->pluck('value');
    }
}
