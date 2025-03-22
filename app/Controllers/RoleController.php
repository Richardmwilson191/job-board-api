<?php

namespace app\Controllers;

use app\Models\Role;

class RoleController extends Controller
{
    private $roleModel;

    public function __construct()
    {
        $this->roleModel = new Role();
    }

    // Get all roles
    public function index()
    {
        header('Content-Type: application/json');

        $roles = $this->roleModel->getAll();
        echo json_encode($roles);
    }

    // Create a role
    public function store()
    {
        $data = file_get_contents('php://input');
        $role = json_decode($data, true);
        $result = $this->roleModel->create($role);

        if ($result) {
            http_response_code(201);
            echo json_encode(["message" => "Role created successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to create role"]);
        }
    }

    // Get role by ID
    public function show()
    {
        header('Content-Type: application/json');

        $id = $this->getIdFromUrl();

        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid role ID']);
            return;
        }

        $role = $this->roleModel->findById($id);
        if ($role) {
            echo json_encode($role);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Role not found']);
        }
    }

    // Update role
    public function update()
    {
        $id = $this->getIdFromUrl();

        $data = file_get_contents('php://input');
        $role = json_decode($data, true);
        $result = $this->roleModel->update($id, $role);

        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'Role updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to update role']);
        }
    }

    // Delete role
    public function delete()
    {
        $id = $this->getIdFromUrl();

        if ($this->roleModel->delete($id)) {
            http_response_code(200);
            echo json_encode(['message' => 'Role deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to delete role']);
        }
    }
}
