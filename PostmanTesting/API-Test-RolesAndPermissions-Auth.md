# Postman API Test

## Table of Contents
- [Base URL](#base-url)
- [Required](#required)
- [Authentication](#authentication)
- [Endpoints](#)
- [Resources](#)

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

## Authentication 
Some of the endpoints require the authentication to work properly, so for this you need:
- Follow the guide in [User Auth Guide](Postman-API-Test-User-Auth.md)
- Register and login to obtain the user token.
- Use this token in the Authorization header.

## Endpoints
### Get /roles
In this endpoint I get the roles with the permissions for each role.

1. Super Admin

<details>

```json
{
    "id": 1,
    "name": "Super Admin",
    "guard_name": "web",
    "created_at": "2025-05-08T09:02:07.000000Z",
    "updated_at": "2025-05-08T09:02:07.000000Z",
    "permissions": [
        {
            "id": 1,
            "name": "System-Configuration",
            "guard_name": "web",
            "created_at": "2025-05-08T09:02:06.000000Z",
            "updated_at": "2025-05-08T09:02:06.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 1
            }
        },
        {
            "id": 2,
            "name": "Manage-Roles",
            "guard_name": "web",
            "created_at": "2025-05-08T09:02:06.000000Z",
            "updated_at": "2025-05-08T09:02:06.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 2
            }
        },
        {
            "id": 3,
            "name": "Manage-Domains",
            "guard_name": "web",
            "created_at": "2025-05-08T09:02:06.000000Z",
            "updated_at": "2025-05-08T09:02:06.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 3
            }
        },
        {
            "id": 4,
            "name": "User Management",
            "guard_name": "web",
            "created_at": "2025-05-08T09:02:06.000000Z",
            "updated_at": "2025-05-08T09:02:06.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 4
            }
        },
        {
            "id": 5,
            "name": "Backup Management",
            "guard_name": "web",
            "created_at": "2025-05-08T09:02:07.000000Z",
            "updated_at": "2025-05-08T09:02:07.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 5
            }
        },
        {
            "id": 6,
            "name": "Import/Export",
            "guard_name": "web",
            "created_at": "2025-05-08T09:02:07.000000Z",
            "updated_at": "2025-05-08T09:02:07.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 6
            }
        },
        {
            "id": 7,
            "name": "Class-Session-Management",
            "guard_name": "web",
            "created_at": "2025-05-08T09:02:07.000000Z",
            "updated_at": "2025-05-08T09:02:07.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 7
            }
        },
        {
            "id": 8,
            "name": "Approve-Changes",
            "guard_name": "web",
            "created_at": "2025-05-08T09:02:07.000000Z",
            "updated_at": "2025-05-08T09:02:07.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 8
            }
        },
        {
            "id": 9,
            "name": "View-All-Class-Sessions",
            "guard_name": "web",
            "created_at": "2025-05-08T09:02:07.000000Z",
            "updated_at": "2025-05-08T09:02:07.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 9
            }
        },
        {
            "id": 11,
            "name": "Edit-Own-Profile",
            "guard_name": "web",
            "created_at": "2025-05-08T09:02:07.000000Z",
            "updated_at": "2025-05-08T09:02:07.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 11
            }
        },
        {
            "id": 12,
            "name": "Request-Changes",
            "guard_name": "web",
            "created_at": "2025-05-08T09:02:07.000000Z",
            "updated_at": "2025-05-08T09:02:07.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 12
            }
        }
    ]
}
```
</details>

2. Admin

<details>

```json
{
        "id": 2,
        "name": "Admin",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:07.000000Z",
        "updated_at": "2025-05-08T09:02:07.000000Z",
        "permissions": [
            {
                "id": 3,
                "name": "Manage-Domains",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:06.000000Z",
                "updated_at": "2025-05-08T09:02:06.000000Z",
                "pivot": {
                    "role_id": 2,
                    "permission_id": 3
                }
            },
            {
                "id": 4,
                "name": "User Management",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:06.000000Z",
                "updated_at": "2025-05-08T09:02:06.000000Z",
                "pivot": {
                    "role_id": 2,
                    "permission_id": 4
                }
            },
            {
                "id": 5,
                "name": "Backup Management",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 2,
                    "permission_id": 5
                }
            },
            {
                "id": 6,
                "name": "Import/Export",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 2,
                    "permission_id": 6
                }
            },
            {
                "id": 7,
                "name": "Class-Session-Management",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 2,
                    "permission_id": 7
                }
            },
            {
                "id": 8,
                "name": "Approve-Changes",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 2,
                    "permission_id": 8
                }
            },
            {
                "id": 9,
                "name": "View-All-Class-Sessions",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 2,
                    "permission_id": 9
                }
            },
            {
                "id": 11,
                "name": "Edit-Own-Profile",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 2,
                    "permission_id": 11
                }
            },
            {
                "id": 12,
                "name": "Request-Changes",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 2,
                    "permission_id": 12
                }
            }
        ]
    }
```
</details>

3. Staff

<details>

```Json
{
        "id": 3,
        "name": "Staff",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:07.000000Z",
        "updated_at": "2025-05-08T09:02:07.000000Z",
        "permissions": [
            {
                "id": 7,
                "name": "Class-Session-Management",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 3,
                    "permission_id": 7
                }
            },
            {
                "id": 8,
                "name": "Approve-Changes",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 3,
                    "permission_id": 8
                }
            },
            {
                "id": 10,
                "name": "View-Own-Class-Sessions",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 3,
                    "permission_id": 10
                }
            },
            {
                "id": 11,
                "name": "Edit-Own-Profile",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 3,
                    "permission_id": 11
                }
            },
            {
                "id": 12,
                "name": "Request-Changes",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 3,
                    "permission_id": 12
                }
            }
        ]
    }
```
</details>

4. Student

<details>

```Json
{
        "id": 4,
        "name": "Student",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:07.000000Z",
        "updated_at": "2025-05-08T09:02:07.000000Z",
        "permissions": [
            {
                "id": 11,
                "name": "Edit-Own-Profile",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 4,
                    "permission_id": 11
                }
            },
            {
                "id": 12,
                "name": "Request-Changes",
                "guard_name": "web",
                "created_at": "2025-05-08T09:02:07.000000Z",
                "updated_at": "2025-05-08T09:02:07.000000Z",
                "pivot": {
                    "role_id": 4,
                    "permission_id": 12
                }
            }
        ]
    }
```
</details>

### Get /permissions
In this endpoint I get the permissions with the information:

```Json
{
        "id": 1,
        "name": "System-Configuration",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:06.000000Z",
        "updated_at": "2025-05-08T09:02:06.000000Z"
    },
    {
        "id": 2,
        "name": "Manage-Roles",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:06.000000Z",
        "updated_at": "2025-05-08T09:02:06.000000Z"
    },
    {
        "id": 3,
        "name": "Manage-Domains",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:06.000000Z",
        "updated_at": "2025-05-08T09:02:06.000000Z"
    },
    {
        "id": 4,
        "name": "User Management",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:06.000000Z",
        "updated_at": "2025-05-08T09:02:06.000000Z"
    },
    {
        "id": 5,
        "name": "Backup Management",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:07.000000Z",
        "updated_at": "2025-05-08T09:02:07.000000Z"
    },
    {
        "id": 6,
        "name": "Import/Export",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:07.000000Z",
        "updated_at": "2025-05-08T09:02:07.000000Z"
    },
    {
        "id": 7,
        "name": "Class-Session-Management",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:07.000000Z",
        "updated_at": "2025-05-08T09:02:07.000000Z"
    },
    {
        "id": 8,
        "name": "Approve-Changes",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:07.000000Z",
        "updated_at": "2025-05-08T09:02:07.000000Z"
    },
    {
        "id": 9,
        "name": "View-All-Class-Sessions",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:07.000000Z",
        "updated_at": "2025-05-08T09:02:07.000000Z"
    },
    {
        "id": 10,
        "name": "View-Own-Class-Sessions",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:07.000000Z",
        "updated_at": "2025-05-08T09:02:07.000000Z"
    },
    {
        "id": 11,
        "name": "Edit-Own-Profile",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:07.000000Z",
        "updated_at": "2025-05-08T09:02:07.000000Z"
    },
    {
        "id": 12,
        "name": "Request-Changes",
        "guard_name": "web",
        "created_at": "2025-05-08T09:02:07.000000Z",
        "updated_at": "2025-05-08T09:02:07.000000Z"
    }
```

## Resources
- [User Auth Guide](Postman-API-Test-User-Auth.md)








