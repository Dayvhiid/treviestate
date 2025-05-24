### API Documentation

#### Authentication Endpoints

##### Register
- **URL**: `/api/register`
- **Method**: `POST`
- **Description**: Register a new user.
- **Request Parameters**:
  - `name` (string, required): The name of the user.
  - `email` (string, required): The email of the user.
  - `password` (string, required): The password of the user.
- **Response Example**:
  ```json
  {
    "message": "User registered successfully",
    "user": {
      "id": 1,
    },
    "token": "your_jwt_token"
  }

##### Login
- **URL**: `/api/login`
- **Method**: `POST`
- **Description**: Login a user.
- **Request Parameters**:
  - `email` (string, required): The email of the user.
  - `password` (string, required): The password of the user.
  - **Headers**:
  - `Accept`(Key): `Application/json`(Value)
- **Response Example**:
  ```json
  {
    "message": "User logged in successfully",
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "johndoe@example.com"
    },
    "token": "your_jwt_token"
  }
  ```

##### Login
- **URL**: `/api/login`
- **Method**: `POST`
- **Description**: Login a user.
- **Request Parameters**:
  - `email` (string, required): The email of the user.
  - `password` (string, required): The password of the user.
  - **Headers**:
  - `Accept`(Key): `Application/json`(Value)
- **Response Example**:
  ```json
  {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "johndoe@example.com"
    },
    "token": "your_jwt_token"
  }
  ```

##### Post Properties
- **URL**: `/api/properties`
- **Method**: `POST`
- **Description**: Login a user.
- **Request Parameters**:
  - `email` (string, required): The email of the user.
  - `password` (string, required): The password of the user.
  - **Headers**:
  - `Authorization`(Key): `Bearer_token`(Value)
   - `Accept`(Key): `Application/json`(Value)
    - `Content-type`(Key): `Multipart/form-data`(Value)
- **Response Example**:
  ```json
  {
    "user": {
        "id": 5,
        "price": "150000.00",
        "location": "Ikeja, Lagos",
        "description": "Nice 2-bedroom...",
        "image_url": "https://.../storage/house.jpg"
    },
  }
  ```  
##### Get User Profile
- **URL**: `/api/user`
- **Method**: `GET`
- **Description**: Get the profile of the authenticated user.
- **Request Headers**:
  - `Authorization` (string, required): Bearer token.
- **Response Example**:
  ```json
  {
    "id": 1,
    "name": "John Doe",
    "email": "johndoe@example.com"
  }
  ```
### Logout
 - **URL**: `/api/user`
- **Method**: `POST`
- **Description**: Logs out the current user.
- **Request Headers**:
  - `Authorization` (string, required): Bearer token.
- **Response Example**:
  ```json
  {
    "id": 1,
    "name": "John Doe",
    "email": "johndoe@example.com"
  }
  ``` 
 You can also leave the body empty as long as the token is passed in the user will be logged out 


##### Get User Properties
- **URL**: `/api/my-properties`
- **Method**: `GET`
- **Description**: Get a list of all user-propeties that has been posted.
- **Request Headers**:
  - `Authorization` (string, required): Bearer token.
- **Response Example**:
  ```json
  {
   
  }
  ``` 

##### Get Prpoerties Profile
- **URL**: `/api/properties`
- **Method**: `GET`
- **Description**: Get a list of all properties.
- **Request Headers**:
  - `Authorization` (string, required): Bearer token.
- **Response Example**:
  ```json
  {
    "id": 1,
    "name": "John Doe",
    "email": "johndoe@example.com"
  }
  ```  
  ### Leeave out all the OAUTH routes for now
    