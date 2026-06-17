<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiDocsController extends Controller
{
    public function index()
    {
        return response()->json([
            'base_url' => url('/api'),
            'endpoints' => [
                'Authentication' => [
                    [
                        'url' => '/api/register',
                        'method' => 'POST',
                        'description' => 'Register a new user account',
                        'params' => ['name' => 'string', 'email' => 'string', 'password' => 'string', 'password_confirmation' => 'string'],
                        'response' => ['user' => ['id' => 1, 'name' => 'John', 'email' => 'john@test.com'], 'token' => '1|xyz...']
                    ],
                    [
                        'url' => '/api/login',
                        'method' => 'POST',
                        'description' => 'Login to existing account',
                        'params' => ['email' => 'string', 'password' => 'string'],
                        'response' => ['user' => ['id' => 1, 'name' => 'John', 'email' => 'john@test.com'], 'token' => '2|abc...']
                    ]
                ],
                'Dashboard' => [
                    [
                        'url' => '/api/dashboard?project_id=1',
                        'method' => 'GET',
                        'description' => 'Get high-level budget calculation and expenses breakdown',
                        'params' => ['project_id' => 'integer (required)'],
                        'response' => [
                            'project' => 'My Home',
                            'budget' => 2000000,
                            'spent' => 50000,
                            'remaining' => 1950000,
                            'outstanding' => 10000,
                            'expenses_breakdown' => ['materials' => 30000, 'labour' => 20000]
                        ]
                    ]
                ],
                'Projects' => [
                    [
                        'url' => '/api/projects',
                        'method' => 'GET',
                        'description' => 'List all projects for the authenticated user',
                        'params' => [],
                        'response' => [['id' => 1, 'name' => 'Home Construction', 'budget' => 2000000, 'status' => 'Active']]
                    ],
                    [
                        'url' => '/api/projects',
                        'method' => 'POST',
                        'description' => 'Create a new project',
                        'params' => ['name' => 'string', 'location' => 'string', 'budget' => 'number', 'expected_completion_date' => 'date'],
                        'response' => ['id' => 1, 'name' => 'Home Construction', 'status' => 'Active']
                    ]
                ],
                'Material Vendors' => [
                    [
                        'url' => '/api/vendors?project_id=1',
                        'method' => 'GET',
                        'description' => 'List vendors for a specific project',
                        'params' => ['project_id' => 'integer'],
                        'response' => [['id' => 1, 'name' => 'ABC Hardware', 'mobile' => '9876543210']]
                    ]
                ],
                'Material Bills' => [
                    [
                        'url' => '/api/bills',
                        'method' => 'POST',
                        'description' => 'Add a new material bill',
                        'params' => ['project_id' => 'integer', 'vendor_id' => 'integer', 'category_id' => 'integer', 'bill_amount' => 'number', 'bill_date' => 'date'],
                        'response' => ['id' => 1, 'bill_amount' => 100000, 'status' => 'Pending']
                    ]
                ],
                'Material Payments' => [
                    [
                        'url' => '/api/payments',
                        'method' => 'POST',
                        'description' => 'Record a payment against a material bill',
                        'params' => ['bill_id' => 'integer', 'amount' => 'number', 'payment_mode' => 'string'],
                        'response' => ['id' => 1, 'amount' => 20000, 'payment_mode' => 'Cash']
                    ]
                ],
                'Labour Contractors' => [
                    [
                        'url' => '/api/labour-contractors?project_id=1',
                        'method' => 'GET',
                        'description' => 'List labour contractors for a project',
                        'params' => ['project_id' => 'integer'],
                        'response' => [['id' => 1, 'name' => 'Ramesh Singh', 'work_type' => 'Mason']]
                    ]
                ],
                'Labour Bills' => [
                    [
                        'url' => '/api/labour-bills',
                        'method' => 'POST',
                        'description' => 'Add a new labour bill',
                        'params' => ['project_id' => 'integer', 'labour_contractor_id' => 'integer', 'amount' => 'number', 'work_description' => 'string'],
                        'response' => ['id' => 1, 'amount' => 5000, 'status' => 'Pending']
                    ]
                ],
                'Labour Payments' => [
                    [
                        'url' => '/api/labour-payments',
                        'method' => 'POST',
                        'description' => 'Record a payment against a labour bill',
                        'params' => ['labour_bill_id' => 'integer', 'amount' => 'number', 'payment_mode' => 'string'],
                        'response' => ['id' => 1, 'amount' => 5000, 'payment_mode' => 'UPI']
                    ]
                ]
            ]
        ]);
    }
}
