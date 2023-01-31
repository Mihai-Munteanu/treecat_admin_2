<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Platform;
use App\Models\ActiveListing;
use App\Models\CustomerStatus;
use App\Models\CustomerHistory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $user = [
            'name' => 'mm',
            'email' => 'mm@test.com',
            'password' => bcrypt('changeme123'),
        ];
        User::create($user);


        $statuses = [
            ['name' => 'internal'],
            ['name' => 'external'],
            ['name' => 'beta']
        ];

        CustomerStatus::upsert($statuses, ['name'], ['name']);

        $platforms = [
            ['name' => 'eBay'],
            ['name' => 'mercari'],
            ['name' => 'poshmark'],
        ];

        Platform::upsert($platforms, ['name'], ['name']);

        for ($i = 1; $i < 11; $i++) {

            for ($y = 0; $y < 10; $y++) {
                $customerData = [
                    'customer_id' => 100 + $i,
                    // 'customer_unique_id' => $i,
                    'date' => now()->addDays($y),
                    'customer_registration_date' => now(),
                    'customer_status_id' => rand(1, 3),
                ];

                $customer = CustomerHistory::create($customerData);

                foreach (['1', '2', '3'] as $platform) {

                    $x = [
                        'customer_history_id' => $customer->id,
                        'date' => now()->addDays($y),
                        'active_listing' => '100' + $i + $y,
                        'platform_id' => $platform,
                    ];
                    ActiveListing::firstOrCreate($x);
                }

                // $q = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'cross_linked_active_listing_mercari' => 100 + $i + $y,
                //     'cross_linked_active_listing_ebay' => 200 + $i + $y,
                //     'cross_linked_active_listing_poshmark' => 300 + $i + $y,
                // ];
                // CrossLinkedActiveListing::firstOrCreate($q);

                // $z = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'cross_linked_sales_count_mercari' => 100 + $i + $y,
                //     'cross_linked_sales_count_ebay' => 200 + $i + $y,
                //     'cross_linked_sales_count_poshmark' => 300 + $i + $y,
                // ];
                // CrossLinkedSalesCount::firstOrCreate($z);

                // $w = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'cross_linked_sales_value_mercari' => 100 + $i + $y,
                //     'cross_linked_sales_value_ebay' => 200 + $i + $y,
                //     'cross_linked_sales_value_poshmark' => 300 + $i + $y,
                // ];
                // CrossLinkedSalesValue::firstOrCreate($w);

                // $xy = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'all_sales_count_mercari' => 100 + $i + $y,
                //     'all_sales_count_ebay' => 200 + $i + $y,
                //     'all_sales_count_poshmark' => 300 + $i + $y,
                // ];
                // AllSalesCount::firstOrCreate($xy);

                // $xz = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'all_sales_value_mercari' => 100 + $i + $y,
                //     'all_sales_value_ebay' => 200 + $i + $y,
                //     'all_sales_value_poshmark' => 300 + $i + $y,
                // ];
                // AllSalesValue::firstOrCreate($xz);

                // $xw = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'treecat_revenue_mercari' => 100 + $i + $y,
                //     'treecat_revenue_ebay' => 200 + $i + $y,
                //     'treecat_revenue_poshmark' => 300 + $i + $y,
                // ];
                // TreecatRevenue::firstOrCreate($xw);

                // $yz = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'new_listings_downloaded_platform_mercari' => 100 + $i + $y,
                //     'new_listings_downloaded_platform_ebay' => 200 + $i + $y,
                //     'new_listings_downloaded_platform_poshmark' => 300 + $i + $y,
                // ];
                // NewListingDownloadedPlatform::firstOrCreate($yz);

                // $yw = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'successful_new_listing_count_mercari' => 100 + $i + $y,
                //     'successful_new_listing_count_ebay' => 200 + $i + $y,
                //     'successful_new_listing_count_poshmark' => 300 + $i + $y,
                // ];
                // SuccessfulNewListingCount::firstOrCreate($yw);

                // $zw = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'de_listing_fail_count_mercari' => 100 + $i + $y,
                //     'de_listing_fail_count_ebay' => 200 + $i + $y,
                //     'de_listing_fail_count_poshmark' => 300 + $i + $y,
                // ];
                // DeListingFailCount::firstOrCreate($zw);

                // $xyz = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'de_listing_success_count_mercari' => 100 + $i + $y,
                //     'de_listing_success_count_ebay' => 200 + $i + $y,
                //     'de_listing_success_count_poshmark' => 300 + $i + $y,
                // ];
                // DeListingSuccessCount::firstOrCreate($xyz);

                // $xyw = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'notification_email_1_mercari' => 100 + $i + $y,
                //     'notification_email_1_ebay' => 200 + $i + $y,
                //     'notification_email_1_poshmark' => 300 + $i + $y,
                // ];
                // NotificationEmail1s::firstOrCreate($xyw);

                // $yzw = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'notification_email_2_mercari' => 100 + $i + $y,
                //     'notification_email_2_ebay' => 200 + $i + $y,
                //     'notification_email_2_poshmark' => 300 + $i + $y,
                // ];
                // NotificationEmail2s::firstOrCreate($yzw);

                // $xyzw = [
                //     'customer_id' => $customer->id,
                //     'date' => now()->addDays($y),
                //     'number_of_guest_account_mercari' => 100 + $i + $y,
                //     'number_of_guest_account_ebay' => 200 + $i + $y,
                //     'number_of_guest_account_poshmark' => 300 + $i + $y,
                // ];
                // NumberOfGuestAccount::firstOrCreate($xyzw);
            }
        }
    }
}
