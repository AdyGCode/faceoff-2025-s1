# Face Off API



## API Aspects
- Coding an API (BRED, MVC)
- Testing (Pest Testing)
- Documentation (Scramble)
- FrontEnd


## Tasks:

### FaceOff Start API
- Core files/packages
    - ApiResponse
    - Scramble
    - Pest
    - Spaite
- Folder Structure
    - app/Http/Controllers/Api/v1/TheController
    ~~- app/Http/Requests/v1~~
   ~~ - routes/api_v1~~
   - tests/Feature/API/featureName/v1/featureName.feature.Test = 'users/UserReadTest'

<br>

**The following just need to be modified to work as an API, within the API controllers foler.**

- [ ] RoleController - Gabriela
- [x] UserController - Cedric
- [x] Cluster, Course, Package, Unit Controllers - Thomas
- [ ] ClassSessionController - Luke


**Each developer should also include comments for Scramble documentation as they modify their work.**


## Review Code and Write Pest Tests for:
- [ ] Thomas - Authorization Management (RoleController, route access)
- [ ] Gabriela - Core Content Management
- [ ] Cedric - Class Session Management
- [ ] Luke - User Management


## Postman Testing
Postman testing should be conducted as additional testing by the original developer of said feature.

- [x] [User & Auth - Cedric](/Postman-API-Test-User-Auth.md)
<br>


# Future Project Versions

## V2

Once Pest testing has been developed and completed use the results / feedback from it to further develop the project.

Refactor the: 
- API Pest tests into a 'api/v1' folder, so 'tests/api/v1'

## V3

As per the assessment "AT2-POR-Pt1" (the blue highlighted bits) we are missing the: 

### Location
Which involves the Campus, Building & Room which should have their own seperate CRUD or BRED operations.

### User
Is also missing some parts being:
- Staff / Student ID
- Alternative email 
- Status

### API Core Content
Pivot table data/ relation within the API responce should be paginated to (depending on the type, min 10). 
