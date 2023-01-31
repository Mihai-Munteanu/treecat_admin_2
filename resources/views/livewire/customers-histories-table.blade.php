<div>

    <div class="py-12 flex">
        filters:
        <div>
            <select wire:model="filters.platforms" class="form-select" multiple id="platforms">
                <option value="all">All</option>
                <option value="mercari">mercari</option>
                <option value="ebay">ebay</option>
                <option value="poshmark">poshmark</option>
            </select>
        </div>
        <div>
            {{-- create label for start date --}}
            Start Date

            <input type='date' wire:model="filters.dateStart" class="form-select" multiple id="dateStart">
            End Date
            <input type='date' wire:model="filters.dateEnd" class="form-select" multiple id="dateStart">


            {{-- <select wire:model="filters.platforms" class="form-select" multiple id="platforms">
                <option value="all">All</option>
                <option value="mercari">mercari</option>
                <option value="ebay">ebay</option>
                <option value="poshmark">poshmark</option>
            </select> --}}
        </div>

        status:
        <div>
            <select wire:model="filters.statuses" class="form-select" multiple id="statuses">
                <option value="all">All</option>
                <option value="1">internal</option>
                <option value="2">external</option>
                <option value="3">beta</option>

            </select>
        </div>

    </div>

    Be like water.
    <table>
        <thead>
            <td class="text-bold text-2xl text-center">
                customer_id
            </td>
            <td class="text-bold text-2xl text-center">
                total
            </td>
            {{-- <td class="text-bold text-2xl text-center">
                date
            </td> --}}
            <td class="text-bold text-2xl text-center">
                status
            </td>
            {{-- <td class="text-bold text-2xl px-2 text-center">
                activeListingMercari
            </td>
            <td class="text-bold text-2xl px-2 text-center">
                activeListingEbay
            </td>
            <td class="text-bold text-2xl px-2 text-center">
                activeListingPoshmark
            </td> --}}
        </thead>
        {{-- {{dd($customers)}} --}}
        @foreach($customersHistories as $customer)

        {{-- {{dd($customer)}} --}}
        <tr class="bg-white border-b hover:bg-gray-100">
            {{-- <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap">
                {{$customer->id }}
            </td> --}}
            <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap">
                {{ $customer->customer_id }}
            </td>
            {{-- <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap">
                {{ $customer->date }}
            </td> --}}
            <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap border-2 border-red-500 ">
                {{$customer?->total_active_listing}}

            </td>
            <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap border-2 border-red-500 ">
                {{$customer?->statusName}}
            </td>

            {{-- <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap">
                {{ $customer->activeListingMercari }}
            </td>

            <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap">
                {{ $customer->activeListingEbay }}
            </td>
            <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap">
                {{ $customer->activeListingPoshmark }}
            </td> --}}
        </tr>
        @endforeach
    </table>

    <div class="w-full">
        <div class="w-96">
            <livewire:components.select-multiple-model-elements :selected="[]" :eventName="'platformSelected'" :model="'App\Models\Platform'" />
            />
        </div>

        {{-- <x-input.select wire:model="perPage" class="w-20">
            <option>5</option>
            <option>10</option>
            <option>15</option>
            <option>20</option>
            <option>25</option>
            <option>30</option> --}}
    </div>
    _______________________

    <table class="w-full">
        <thead>
            <tr class="text-xs font-bold text-center text-black" style="background-color: #d9d9d9">
                <x-table.heading sortable multi-column wire:click="sortBy('customer_id')" :direction="$sorts['customer_id'] ?? null">Customer Id</x-table.heading>
                <x-table.heading sortable multi-column wire:click="sortBy('total_active_listing')" :direction="$sorts['total_active_listing'] ?? null">Total</x-table.heading>
                <x-table.heading sortable multi-column wire:click="sortBy('statusName')" :direction="$sorts['statusName'] ?? null">Status</x-table.heading>
                <th scope="col" class="px-4 py-2 text-right text-sm text-gray-700 tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @if($customersHistories->isEmpty())
            <tr class="bg-white border-b">
                <td colspan="100" class="py-2 text-center text-gray-500 text-md">
                    No results found
                </td>
            </tr>
            @endif

            @foreach($customersHistories as $history)
            <tr class="text-sm font-medium text-center text-gray-500 bg-white border-b hover:bg-gray-100">
                <td class="px-4 py-2 whitespace-nowrap">
                    {{ $history->customer_id }}
                </td>
                <td class="px-4 py-2 whitespace-nowrap">
                    {{ $history->total_active_listing }}
                </td>
                <td class="px-4 py-2 whitespace-nowrap">
                    {{ $history->statusName }}
                </td>
                <td class="px-4 py-2 whitespace-nowrap">
                    {{-- space for action, if the case --}}
                </td>

            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="200" class="h-12 px-4 py-2 bg-gray-50">
                    {{ $customersHistories->links() }}
                </td>
            </tr>
        </tfoot>
    </table>



</div>
