<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiDocsController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Available API Endpoints Documentation',
            'endpoints' => [
                [
                    'method' => 'POST',
                    'uri' => '/api/register',
                    'description' => 'Register a new user',
                    'required_params' => ['name', 'email', 'password', 'password_confirmation'],
                    'response' => [
                        'user' => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
                        'token' => '1|laravel_sanctum_token...'
                    ]
                ],
                [
                    'method' => 'POST',
                    'uri' => '/api/login',
                    'description' => 'Login a user',
                    'required_params' => ['email', 'password'],
                    'response' => [
                        'user' => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
                        'token' => '2|laravel_sanctum_token...'
                    ]
                ],
                [
                    'method' => 'POST',
                    'uri' => '/api/logout',
                    'description' => 'Logout user and invalidate token',
                    'required_params' => ['(Headers) Authorization: Bearer {token}'],
                    'response' => [
                        'message' => 'Logged out successfully'
                    ]
                ],
                [
                    'method' => 'GET',
                    'uri' => '/api/projects',
                    'description' => 'List all projects for the authenticated user (Paginated)',
                    'required_params' => ['(Headers) Authorization: Bearer {token}'],
                    'response' => [
                        'data' => [
                            [
                                'id' => 1,
                                'name' => 'Downtown Skyscraper',
                                'location' => 'New York',
                                'budget' => 5000000.00,
                                'start_date' => '2026-07-01'
                            ]
                        ],
                        'links' => ['first' => '...', 'next' => null],
                        'meta' => ['current_page' => 1, 'total' => 1]
                    ]
                ],
                [
                    'method' => 'POST',
                    'uri' => '/api/projects',
                    'description' => 'Create a new project',
                    'required_params' => [
                        '(Headers) Authorization: Bearer {token}', 
                        'name (string)', 
                        'location (string)', 
                        'budget (numeric)', 
                        'start_date (date)'
                    ],
                    'response' => [
                        'data' => [
                            'id' => 2,
                            'name' => 'Suburban Mall',
                            'location' => 'Chicago',
                            'budget' => 1500000.00,
                            'start_date' => '2026-08-15'
                        ]
                    ]
                ],
                [
                    'method' => 'PUT',
                    'uri' => '/api/projects/{project}',
                    'description' => 'Update an existing project',
                    'required_params' => [
                        '(Headers) Authorization: Bearer {token}', 
                        '(URL) project ID',
                        'name (string)', 
                        'location (string)', 
                        'budget (numeric)', 
                        'start_date (date)'
                    ],
                    'response' => [
                        'data' => [
                            'id' => 1,
                            'name' => 'Updated Skyscraper Name',
                            'location' => 'New York',
                            'budget' => 5500000.00,
                            'start_date' => '2026-07-01'
                        ]
                    ]
                ],
                [
                    'method' => 'GET',
                    'uri' => '/api/contractors',
                    'description' => 'List all contractors (Paginated)',
                    'required_params' => ['(Headers) Authorization: Bearer {token}'],
                    'response' => [
                        'data' => [
                            [
                                'id' => 1,
                                'name' => 'Bob Builder',
                                'phone' => '555-1234',
                                'specialty' => 'Plumbing',
                                'location' => 'New York'
                            ]
                        ]
                    ]
                ],
                [
                    'method' => 'POST',
                    'uri' => '/api/contractors',
                    'description' => 'Add a new contractor',
                    'required_params' => [
                        '(Headers) Authorization: Bearer {token}',
                        'name (string)',
                        'phone (string)',
                        'specialty (string)',
                        'location (string)'
                    ],
                    'response' => [
                        'data' => [
                            'id' => 2,
                            'name' => 'Alice Electrician',
                            'phone' => '555-9876',
                            'specialty' => 'Electrical',
                            'location' => 'Chicago'
                        ]
                    ]
                ],
                [
                    'method' => 'GET',
                    'uri' => '/api/contractors/near/{location}',
                    'description' => 'Find contractors near a specific location',
                    'required_params' => ['(Headers) Authorization: Bearer {token}', '(URL) location'],
                    'response' => [
                        'data' => [
                            [
                                'id' => 1,
                                'name' => 'Bob Builder',
                                'specialty' => 'Plumbing',
                                'location' => 'New York'
                            ]
                        ]
                    ]
                ],
                [
                    'method' => 'POST',
                    'uri' => '/api/expenses',
                    'description' => 'Log a new expense for a project',
                    'required_params' => [
                        '(Headers) Authorization: Bearer {token}', 
                        'project_id (exists)', 
                        'category (string)', 
                        'amount (numeric)', 
                        'date (date)'
                    ],
                    'response' => [
                        'data' => [
                            'id' => 1,
                            'project_id' => 1,
                            'category' => 'Materials',
                            'amount' => 15000.00,
                            'date' => '2026-06-15'
                        ]
                    ]
                ],
                [
                    'method' => 'GET',
                    'uri' => '/api/expenses/project/{projectId}',
                    'description' => 'Get all expenses for a specific project',
                    'required_params' => [
                        '(Headers) Authorization: Bearer {token}', 
                        '(URL) projectId'
                    ],
                    'response' => [
                        'data' => [
                            [
                                'id' => 1,
                                'project_id' => 1,
                                'category' => 'Materials',
                                'amount' => 15000.00,
                                'date' => '2026-06-15'
                            ]
                        ]
                    ]
                ],
                [
                    'method' => 'POST',
                    'uri' => '/api/payments',
                    'description' => 'Log a payment to a contractor for a project',
                    'required_params' => [
                        '(Headers) Authorization: Bearer {token}', 
                        'project_id (exists)', 
                        'contractor_id (exists)', 
                        'amount (numeric)', 
                        'date (date)'
                    ],
                    'response' => [
                        'data' => [
                            'id' => 1,
                            'project_id' => 1,
                            'contractor_id' => 1,
                            'amount' => 5000.00,
                            'date' => '2026-06-16',
                            'project' => ['id' => 1, 'name' => 'Downtown Skyscraper'],
                            'contractor' => ['id' => 1, 'name' => 'Bob Builder']
                        ]
                    ]
                ],
                [
                    'method' => 'GET',
                    'uri' => '/api/payments/project/{projectId}',
                    'description' => 'Get all payments associated with a specific project',
                    'required_params' => [
                        '(Headers) Authorization: Bearer {token}', 
                        '(URL) projectId'
                    ],
                    'response' => [
                        'data' => [
                            [
                                'id' => 1,
                                'project_id' => 1,
                                'contractor_id' => 1,
                                'amount' => 5000.00,
                                'date' => '2026-06-16'
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }
}
