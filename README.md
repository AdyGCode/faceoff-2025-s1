# Student Cheat Sheet SaaS Application Mini Project Brief

## Project Overview
Web-based system for managing student class rosters with photos and personal details, providing lecturers with visual cheat sheets for their sessions.

The project does NOT need a timetabling capability. It acts as a cheat sheet for lecturers.

## Technical Stack
- Laravel 11
- PHP 8.3
- SQL Database (Primary)
- Optional: Livewire, MongoDB
- GitHub for version control

## Team Structure and Timeline
- 4 team members
- 3-week development timeline
- Collaborative development via GitHub repository
- Project management through GitHub Projects and Issues

## Roles and Permissions

### Role Hierarchy
- Super Admin
  - System configuration
  - Role management
  - Domain whitelist management
- Admin
  - User management
  - Data import/export
  - Backup management
- Staff
  - Class Session management
  - Student approval
  - Report generation
- Student
  - Profile management
  - Change requests
  - Photo submission

### Permission Matrix
| Permission               | SuperAdmin | Admin | Staff | Student |
| ------------------------ | ---------- | ----- | ----- | ------- |
| System Configuration     | ✓          | -     | -     | -       |
| Manage Roles             | ✓          | -     | -     | -       |
| Manage Domains           | ✓          | ✓     | -     | -       |
| User Management          | ✓          | ✓     | -     | -       |
| Backup Management        | ✓          | ✓     | -     | -       |
| Import/Export            | ✓          | ✓     | -     | -       |
| Class Session Management | ✓          | ✓     | ✓     | -       |
| Approve Changes          | ✓          | ✓     | ✓     | -       |
| View All Class Sessions  | ✓          | ✓     | -     | -       |
| View Own Class Sessions  | ✓          | ✓     | ✓     | -       |
| Edit Own Profile         | ✓          | ✓     | ✓     | ✓       |
| Request Changes          | ✓          | ✓     | ✓     | ✓       |

# Feature Requirements

### Core Infrastructure
- Laravel 11 based system
- PHP 8.3 compatibility
- SQL database (SQLite for development)
- Secure file storage system
- Domain email validation system
- Automated backup system

## Phase 1

### Authentication & Authorization, 5 - Gabriela
- Role Setup (using Spatie)

- Role-based access control: (Gabriela)
  - Super Admin: Full system access
  - Admin: System management
  - Staff: Class management
  - Student: Personal profile access

<br>

- Email verification system
- Domain whitelist management
- Password security requirements

### User Management - Cedric
- Profile Requirements:
  - Given and/or Family name (at least one required)
  - Preferred name (optional)
  - Preferred pronouns
  - Valid email from approved domain
  - Profile photo

<br>

- Super Admin to create users
- Change request system for updates
- Email verification and bounce checking

### Course Management - Thomas
- Data Structure:
  - Packages (contains multiple courses)
  - Courses (core, specialist, elective units)
  - Units (part of courses and clusters)
  - Clusters (1-8 units)

<br>

- ~~Import Capabilities:~~
  - ~~CSV/Excel file support~~
  - Data validation
  - Error handling
  - Relationship verification

### Class Session Management - Luke 
- Features:
  - Course/Cluster assignment
  - Start/End dates
  - Duration ~~tracking~~
  - Lecturer assignment (Staff)

<br>

- ~~Import Options:~~
  - ~~CSV/Excel import~~
  - ~~ICS feed integration~~
  - ~~Manual entry~~
- ~~Scheduling:~~
  - ~~Conflict detection~~
  - ~~Calendar interface~~
  - ~~Duration validation~~

### Data Connection, 1 - Thomas
- Create and connect all database tables
  - php artisan migrations -m "models"

  "Packages has one or more Course, Courses have one Packages"

  "Courses have one or more units, units can be in one or more Courses."

  "Courses have one or more Clusters, Clusters can be in one or more Courses."

  "Clusters have one or more Units"

  "ClassSessions have one Cluster, one Staff and one or more Students"

  "Students are enrolled into zero or more ClassSessions" 

## Displays & Views
- Dashboard View:
  - Course section
    - displays all course info 
  - Class Session section
    - displays the class session info that the student belongs to

- Other Views:
  - 


<br>

## Phase 2

### Image Management
- Upload Requirements:
  - PNG/JPG formats only
  - Size: 250KB maximum
  - Dimensions: 512x512px minimum, 1024x1024px maximum
  
<br>

- Processing Features:
  - Automatic resizing
  - Interactive cropping interface
  - AI-assisted face detection
  - Head/shoulders positioning guide
  - Web Cam capture interface
  - Drag-and-drop upload
  
<br>

- Storage Features:
  - UUID-based file naming
  - Secure storage location
  - Download prevention
  - Multiple image versions (original, processed, thumbnail)

### Cheat Sheet Generation
- Features:
  - Student photos
  - Names (Given, Family, Preferred)
  - Pronouns
  - Session-specific grouping
  - Print optimization
  - Layout customization

### Data Import/Export
- Import Validation:
  - File format verification
  - Schema validation
  - Data type checking
  - Relationship integrity
  - Error reporting
  
<br>

- Export Features:
  - Full system backup
  - Selective data export
  - Multiple format support

### System Administration
- Backup Management:
  - Daily automated backups
  - 30-day retention
  - Monthly archives
  - Annual archives
  - Integrity verification
  
<br>

- System Configuration:
  - Email domain management
  - Role/Permission settings
  - System parameters
  - Import/Export settings

## Development Requirements
- Version Control:
  - GitHub repository
  - Branch protection rules
  - Pull request workflow
  - Code review process
  
<br>

- Testing:
  - Pest testing framework
  - Required test coverage
  - Integration tests
  - Unit tests
  
<br>

- Documentation:
  - Code documentation
  - API documentation
  - User guides
  - Setup instructions

## Data Structure
- Package:
  - Course IDs
  - National Code
  - Title
  - TGA Status

<br>

- Course:
  - Package IDs
  - Cluster IDs
  - Unit IDs
  - National Code
  - AQF Level
  - Title
  - TGA Status
  - State Code
  - Nominal Hours
  
<br>

- Cluster:
  - Short Code
  - Title
  - Qualification
  - Unit IDs

<br>

- Unit:
  - National Code
  - Title
  - TGA Status
  - State Code
  - Nominal Hours

<br>

- ClassSession:
  - Cluster ID
  - Staff ID 
  - Student IDs
  - Start Date
  - End Date
  - Start Time
  - End Time
  - Duration (mins)

<br>

### Users -v1

*(Super Admin, Admin, Staff, Students)*

- Users:
  - Role
  - Given Name
  - Family Name
  - Preferred Name
  - Pronouns
  - Email
  - Address
  - Password

<br>

### ~~Users -v2~~

*(Super Admin, Admin, Staff, Students)*

- Users:
  - username
  - email
  - password

<br>

- Staff & Students:
  - Given Name
  - Family Name
  - Preferred Name
  - Pronouns
  - Email
  - Address
  - Password

<br>

**Check the given excel doc in teams for the data*