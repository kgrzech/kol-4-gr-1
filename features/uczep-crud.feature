Feature: I would like to edit uczep

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/uczep/"
    Then I should not see "<uczep>"
     And I follow "Create a new entry"
    Then I should see "Uczep creation"
    When I fill in "Name" with "<uczep>"
     And I fill in "Age" with "<age>"
     And I press "Create"
    Then I should see "<uczep>"
     And I should see "<age>"

  Examples:
    | uczep     | age |
    | uczep1    | 1   |
    | uczep2    | 2   |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/uczep/"
    Then I should not see "<new-uczep>"
    When I follow "<old-uczep>"
    Then I should see "<old-uczep>"
    When I follow "Edit"
     And I fill in "Name" with "<new-uczep>"
     And I fill in "Age" with "<new-age>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-uczep>"
     And I should see "<new-age>"
     And I should not see "<old-uczep>"

  Examples:
    | old-uczep     | new-uczep  | new-age    |
    | uczep1        | uczep3     | 3          |
    | uczep2        | uczep4     | 4          |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/uczep/"
    Then I should see "<uczep>"
    When I follow "<uczep>"
    Then I should see "<uczep>"
    When I press "Delete"
    Then I should not see "<uczep>"

  Examples:
    |  uczep    |
    |  uczep3   |
    |  uczep4   |