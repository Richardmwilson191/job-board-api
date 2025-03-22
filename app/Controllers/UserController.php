<?php

namespace app\Controllers;

use app\Models\User;

class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // Get all users
    public function index()
    {
        header('Content-Type: application/json');

        $users = $this->userModel->getAll();
        echo json_encode($users);
    }

    // Create a user
    public function store()
    {
        $data = file_get_contents('php://input');
        $user = json_decode($data, true);
        $result = $this->userModel->create($user);

        if ($result) {
            http_response_code(201);
            echo json_encode(["message" => "User created successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to create user"]);
        }
    }

    // Get user by ID
    public function show()
    {
        header('Content-Type: application/json');

        $id = $this->getIdFromUrl();

        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid user ID']);
            return;
        }

        $user = $this->userModel->findById($id);
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'User not found']);
        }
    }

    // Update user
    public function update()
    {
        $id = $this->getIdFromUrl();

        $data = file_get_contents('php://input');
        $user = json_decode($data, true);
        $result = $this->userModel->update($id, $user);

        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'User updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to update user']);
        }
    }

    // Delete user
    public function delete()
    {
        $id = $this->getIdFromUrl();

        if ($this->userModel->delete($id)) {
            http_response_code(200);
            echo json_encode(['message' => 'User deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to delete user']);
        }
    }
}
