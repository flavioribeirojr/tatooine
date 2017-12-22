# Tatooine
Start point for newer projects. Build with Laravel and Vue :ok_hand:
#### Some cool stuff:
* Authorization implemented with Laravel Auth
* Security schema for management of user and their permissions
* Some cool reusable Vue components, such as a Datagrid and Action (buttons and anchors)
* Custom Menu for each user
* Controller to show/hide buttons and anchors(with Action component)

# Build
To get going you only need to do the following:

``` sh
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate && php artisan db:seed
$ npm install
$ npm run dev
$ ./vendor/bin/phpunit
$ php artisan serve 
```

# Usage

#### Seeds
All your routes (resources/permissions) must me mapped in the database, so that the permission control can work properly. To create new resources and their permissions you have to register them in `ResourcesPermissionsSeeder` class. This is simply done by:
``` php
$this->createNewResource(['users' => 'User management'], [
            'index'   => 'Users list', 
            'create'  => 'Creates new user', 
            'edit'    => 'Update user info', 
            'delete'  => 'Delete a user', 
            'details' => 'Manage user profiles'
]);
```

> **Note**: Tatooine only accept routes in the `resource/permission/{parameters}` format.

> **Note**: You can change the method description, Tatooine will update it info. You can also delete a permission, just remove it from the permissions `array`.

To run the seeder you can use the command:
`$ php artisan resource:run`

### Custom configuration
Tatooine provides a flexible way to design your routes. You can easily set in your .env like the following:
```
BASE_ROUTE='tatooine' //Used as the first part of your route. Ex.: yoursystem.com/tatooine/home
MIX_BASE_ROUTE='security' //This one is used by JS to append on AJAX calls
CUSTOM_HOME='home' //Where the application goes when is accessed and after login
```
Now Tatooine knows how to map your routes.

### Helper functions
There is a `Helper` class (in app/Helper.php) where are two useful global methods
* **baseUrl**: Retrieves your application full url with your `base_route`(Ex.: `yoursystem.com/tatooine`). This function have an optional parameter `$complement`, wich can be used to complement your base route
(Ex.: `yoursystem.com/tatooine/users/create`)

* **home**: Simple function to return the full path of your custom home route

### Tatooine super classes
Tatooine comes with three super classes: Model, Repository and Request. The application use them instead of the native classes of Laravel for aditional funcionalities. They live on `Core` namespace(Ex.:`Core\Model`)

* **Model**: Has just one method, getFilterColumns(), wich returns the `$filterColumns` array containing the "filterable" columns and the corresponding operator for the filter to use. This array must be defined in your Model classes like bellow:
  ``` php
  $filterColumns = [
      'usr_name' => 'like',
      'usr_enabled' => '='
  ]
  ```
 * **Request**: Simple extend it and define rules() method, more details on the laravel documentation: https://laravel.com/docs/5.5/validation#form-request-validation
 * **Repository**: Accepts an Model instance. Has one public method, listModel([]). You may use it for retrieve paginated and filtered data. You can call any other `Eloquent\Model` method, the Repository class will pass the call to its Model instance (unless a method with the same name is defined in it)
   - **Tip**: Use the `listModel` method in combination with DataGrid component(described bellow).

### Available Vue components
Tatooine comes shipped with two reusable components, Action and DataGrid.

#### Action
> `<action></action>`

This component can render a button/anchor dynamically, based on the user permissions. The usage is simle as below:
``` html
<action
  action="users/create"
  aclass="btn btn-primary"
  icon="fa fa-plus"
  type="button"
  @btn-clicked="doSomethingWithThis"
>
  Criar novo usuário
</action>
```
 Action props:
 * **action**: The url to the action. In an anchor it will be an `href`. Action will use it to check permissions
 * **aclass**: Will aply `class` to the anchor/button
 * **icon(optional)**: Will set an icon to the button
 * **type**: Action component will use this to determine if it will render a anchor or a button. Possible values are: 'anchor' and 'button'
 
 Action events:
 * **btn-clicked**: When action type is 'button', the Action component attach a btn-clicked event to the `click` native event so that you can control what it will do. Then you can listen to the event like below:
 ``` js
 doSomethingWithThis (url) {
  //Whatever you want
 }
```

> ***Note***: The component has a `slot` inside the anchor/button tag. So that you can pass additional info inside the component

#### Datagrid
> `<data-grid></data-grid>`

This component renders a paginated grid, with filter options. Also, you can define actions for each row. The usage:

``` html
<data-grid 
  url="{{baseUrl('/users/list')}}"
  primary-key="usr_id"
  :user-fields="{usr_name: 'User', usr_email: 'E-mail', usr_username: 'Username', usr_enabled: 'Status'}"
  :user-filters="{
    usr_name: {type: 'text', size: 4}, 
    usr_enabled: {type: 'select', size: 3, options: {1: 'Enabled', 0: 'Disabled'}}
  }"
  :actions="[
    {method: 'edit', url: 'users/edit'}, 
    {method: 'delete', url: 'users/delete'}, 
    {method: 'details', url: 'users/details'}
  ]"
  :mutators="{usr_enabled: {0: 'Disabled', 1: 'Enabled'}}"
></data-grid>
```
DataGrid props:
* **url**: You API to retrieve the data to DataGrid.
* **primary-key**: This will be used in the grid actions as a parameter, must be a present field on the data retrieved from the server.
* **user-fields**: The fields that the DataGrid will show. Has the `{field_name: 'fieldTitle'}` format.
* **actions**: You may define three type of actions: edit, delete and details. DataGrid will render delete action as a button and the other two will be anchors. In each action you must pass the url for the action. The DataGrid will pass the `primaryKey` as the parameter for each url.
* **user-filters**: To setup the filters you have to pass an object with info for each field. You must pass the type of the filter and it's size(just a number between 1 and 12, DataGrid will automatically convert to bootstrap grids classes). The type can be 'text', 'number' or 'select'. For 'select' type will have to define also its options, like bellow:
  ``` js
    options: {1: 'Option one', 2: 'Option 2'}
  ```
  
  > **Note 1**: The object key is used as the filter value
  
  > **Note 2**: This filter feature will be improved to allow other input types(such as 'checkbox' and 'radio
  
* **mutators**: To change how data is going to be visualized you can apply the mutators, just a simple key-value mechanism, you pass the value and the corresponding information to show. Like in the pattern: `{usr_enabled: {0: 'Disabled', 1: 'Enabled'}}`
  

  
