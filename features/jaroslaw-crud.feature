Feature: I would like to edit jaroslaw

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/jaroslaw/"
    Then I should not see "<name>"
     And I follow "Create a new entry"
    Then I should see "Ireland creation"
    When I fill in "Name" with "<name>"
     And I fill in "Description" with "<size>"
     And I fill in "Price" with "<size>"
     And I press "Create"
    Then I should see "<name>"
     And I should see "<caption>"
     And I should see "<size>"

  Examples:
    | name        | caption         | size |
    | Akacjowa    | wewnetrzna      |   4  |
    | Basztowa    | gminna          |   2  |
    | Brzostkow   | powiatowa       |   2 |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/jaroslaw/"
    Then I should not see "<new-name>"
    When I follow "<old-name>"
    Then I should see "<old-name>"
    When I follow "Edit"
     And I fill in "Name" with "<new-name>"
     And I fill in "Descryption" with "<new-caption>"
     And I fill in "Price" with "<new-size>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-name>"
     And I should see "<new-caption>"
     And I should see "<new-size>"    
     And I should not see "<old-name>"

  Examples:
    | old-name        | new-name    | new-caption   | new-size  |
    | Akacjowa        | Dojazdowa   |   gminna      |     3     |
    | Basztowa        | Kamienna    |   kamienna    |     4     |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/jaroslaw/"
    Then I should see "<name>"
    When I follow "<name>"
    Then I should see "<name>"
    When I press "Delete"
    Then I should not see "<name>"

  Examples:
    |  name       |
    | Brzostkow   |
    | Dojazdowa   |
    | Kamienna    |