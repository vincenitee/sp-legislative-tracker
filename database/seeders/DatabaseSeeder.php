<?php

namespace Database\Seeders;

use App\Models\Ordinance;
use App\Models\Resolution;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $ordinances = [
            [
                'ordinance_number' => 'PO-2026-001',
                'title' => 'An Ordinance Enacting the Provincial Environment and Natural Resources Code of La Union',
                'date_passed' => '2026-02-15',
                'author_sponsor' => 'Hon. Maria Cruz',
                'description' => 'Establishes comprehensive policies for environmental protection, waste management, and conservation across the province.',
                'status' => 'active',
            ],
            [
                'ordinance_number' => 'PO-2026-002',
                'title' => 'An Ordinance Promoting Sustainable Agriculture and Organic Farming Practices in the Province',
                'date_passed' => '2026-04-10',
                'author_sponsor' => 'Hon. Juan Dela Cruz',
                'description' => 'Provides subsidies, training, and market support for local farmers transitioning to sustainable agriculture.',
                'status' => 'active',
            ],
            [
                'ordinance_number' => 'PO-2026-003',
                'title' => 'An Ordinance Institutionalizing the Provincial Disaster Risk Reduction and Climate Resilience Program',
                'date_passed' => '2026-06-22',
                'author_sponsor' => 'Hon. Roberto Santos',
                'description' => 'Strengthens barangay and municipal disaster preparedness and early warning systems.',
                'status' => 'active',
            ],
        ];
        foreach ($ordinances as $ordinance) {
            Ordinance::updateOrCreate(
                ['ordinance_number' => $ordinance['ordinance_number']],
                $ordinance
            );
        }

        $resolutions = [
            [
                'resolution_number' => 'PR-2026-0101',
                'title' => 'A Resolution Supporting the Department of Agriculture Regional Modernization Program for Local Farmers',
                'date_passed' => '2026-03-05',
                'author_sponsor' => 'Hon. Juan Dela Cruz',
                'description' => 'Expresses full support and allocates counterpart provincial assistance for agricultural mechanization.',
                'status' => 'adopted',
            ],
            [
                'resolution_number' => 'PR-2026-0102',
                'title' => 'A Resolution Commending Coastal Municipalities for Excellence in Marine Environment Preservation',
                'date_passed' => '2026-05-18',
                'author_sponsor' => 'Hon. Maria Cruz',
                'description' => 'Recognizes outstanding coastal clean-up and marine sanctuary management initiatives.',
                'status' => 'adopted',
            ],
            [
                'resolution_number' => 'PR-2026-0103',
                'title' => 'A Resolution Authorizing the Provincial Governor to Enter into a Memorandum of Agreement for Digital Governance',
                'date_passed' => '2026-08-12',
                'author_sponsor' => 'Hon. Elena Reyes',
                'description' => 'Covers the digitization of legislative records and public information systems.',
                'status' => 'adopted',
            ],
        ];
        foreach ($resolutions as $resolution) {
            Resolution::updateOrCreate(
                ['resolution_number' => $resolution['resolution_number']],
                $resolution
            );
        }
    }
}
