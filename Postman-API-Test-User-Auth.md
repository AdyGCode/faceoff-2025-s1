# Postman API Test

[Back](/FaceOff-API.md)

## Table of Contents
- [Base URL](#base-url)
- [Required](#required)
- [Authentication](#authentication)
- [User Management](#user-management)


## Base URL

[Back](#table-of-contents)   

`http://faceoff-2025-s1.test/api/v1`

## Required

[Back](#table-of-contents)   

- Add Header `Key`: accept, `Value`: application/json
- Set Body `raw`, `JSON`

> [!NOTE]
> If endpoint required token, 
> - Set Authorization `Bearer Token`
> - Add User's `Token`

<hr>

## Authentication

[Back](#table-of-contents)   

All endpoints under /users require authentication via `Laravel Sanctum`

### Register
- **Endpoint**: `Post /auth/register`
- **Description**: Register a new user.
- **Request Body**:

```json
{
    "given_name": "test",
    "preferred_pronouns": "him",
    "email": "test@example.com.au",
    "password": "Password1",
    "password_confirmation": "Password1"
}
```

- **Results**

![Status](/resources/img/auth/201.png)
```json
{
    "success": true,
    "message": "You are registered successfully!",
    "data": {
        "user": {
            "given_name": "test",
            "preferred_pronouns": "him",
            "email": "test@example.com.au",
            "name": "test",
            "profile_photo": "avatar.png",
            "updated_at": "2025-04-30T03:44:19.000000Z",
            "created_at": "2025-04-30T03:44:19.000000Z",
            "id": 1
        },
        "token": "1|gLlLKDpYY5paJaI1WQyZtbxQ3bbsq8vxdAFDG2Z6b98435ae"
    }
}
```

### Login
- **Endpoint**: `Post /auth/login`
- **Description**: Authenticate a user and receive an access token.
- **Request Body**:

```json
{
  "email": "test@example.com.au",
  "password": "Password1"
}
```

- **Results**

![Status](/resources/img/auth/200.png)
```json
{
    "success": true,
    "message": "You are logged in.",
    "data": {
        "user": {
            "id": 1,
            "given_name": "test",
            "family_name": null,
            "name": "test",
            "preferred_pronouns": "him",
            "email": "test@example.com.au",
            "email_verified_at": null,
            "profile_photo": "avatar.png",
            "created_at": "2025-04-30T03:44:19.000000Z",
            "updated_at": "2025-04-30T03:44:19.000000Z",
            "role": "student",
            "roles": []
        },
        "role": [],
        "token": "2|zBCnAiGyYBKWu0AOmrRwPCCOZR8iH1NaleWEcSD69c312ac8"
    }
}
```

### Logout
- **Endpoint**: `Post /auth/register`
- **Description**: Revoke the authenticated user's token
- **Request Token**: `Logged User Token`
- **Results**

![Status](/resources/img/auth/200.png)
```json
{
    "success": true,
    "message": "You are logged out.",
    "data": null
}
```

### Logged user details
- **Endpoint**: `Get /auth/user`
- **Description**: Get details of logged user
- **Request Token**: `Logged User Token`
- **Results**

![Status](/resources/img/auth/200.png)
```json
{
    "id": 1,
    "given_name": "test",
    "family_name": null,
    "name": "test",
    "preferred_pronouns": "him",
    "email": "test@example.com.au",
    "email_verified_at": null,
    "profile_photo": "avatar.png",
    "created_at": "2025-04-30T03:44:19.000000Z",
    "updated_at": "2025-04-30T03:44:19.000000Z",
    "role": "student"
}
```

<hr>


## User Management
[Back](#table-of-contents)   

All endpoints below require `authentication`. Include the Authorization header with your `Bearer token`.

### List Users
- **Endpoint**: `Get /users`
- **Description**: Retrieve a paginated list of users.
- **Request Token**: `Logged User Token`
- **Results**

![Status](/resources/img/auth/201.png)
```json
{
  "data": [
    {
      "id": 1,
      "name": "John",
      "email": "john.doe@example.com",
    },
  ],
  "links": {
    "first": "http://localhost:8000/api/v1/users?page=1",
    "last": "http://localhost:8000/api/v1/users?page=10",
    "prev": null,
    "next": "http://localhost:8000/api/v1/users?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 10,
    "path": "http://localhost:8000/api/v1/users",
    "per_page": 10,
    "to": 10,
    "total": 100
  }
}
```

### Get User Details
- **Endpoint**: `Get /users/{id}`
- **Description**:  Retrieve details of a specific user by ID.
- **Request Token**: `Logged User Token`
- **Results**

![Status](/resources/img/auth/200.png)
```json
{
    "success": true,
    "message": "User retrieved successfully",
    "data": {
        "id": 1,
        "given_name": "test",
        "family_name": null,
        "name": "test",
        "preferred_pronouns": "him",
        "email": "test@example.com.au",
        "email_verified_at": null,
        "profile_photo": "avatar.png",
        "created_at": "2025-04-30T03:44:19.000000Z",
        "updated_at": "2025-04-30T03:44:19.000000Z",
        "role": "student"
    }
}
```

### Create User
- **Endpoint**: `Post /users`
- **Description**: Create a new user.
- **Request Token**: `Logged User Token`

- **Request Body**:

```json
{
    "given_name": "test",
    "preferred_pronouns": "him",
    "email": "test1234@example.com.au",
    "password": "Password1",
    "password_confirmation": "Password1"
}
```

- **Results**

![Status](/resources/img/auth/201.png)
```json
{
    "success": true,
    "message": "User created successfully!",
    "data": {
        "given_name": "test",
        "preferred_pronouns": "him",
        "email": "test1234@example.com.au",
        "name": "test",
        "profile_photo": "avatar.png",
        "updated_at": "2025-04-30T14:43:07.000000Z",
        "created_at": "2025-04-30T14:43:07.000000Z",
        "id": 2
    }
}
```

### Update User
- **Endpoint**: `Put /users/{id}`
- **Description**: Update an existing user’s information.
- **Request Token**: `Logged User Token`

- **Request Body**:

```json
{
    "given_name": "test1234"
}
```

- **Results**

![Status](/resources/img/auth/200.png)
```json
{
    "success": true,
    "message": "User updated successfully!",
    "data": {
        "id": 1,
        "given_name": "test1234",
        "family_name": null,
        "name": "test",
        "preferred_pronouns": "him",
        "email": "test@example.com.au",
        "email_verified_at": null,
        "profile_photo": "avatar.png",
        "created_at": "2025-04-30T03:44:19.000000Z",
        "updated_at": "2025-04-30T14:45:31.000000Z",
        "role": "student"
    }
}
```

### Delete User
- **Endpoint**: `Delete /users/{id}`
- **Description**: Delete a user by ID.
- **Request Token**: `Logged User Token`
- **Results**

![Status](/resources/img/auth/200.png)
```json
{
    "success": true,
    "message": "User deleted successfully",
    "data": null
}
```