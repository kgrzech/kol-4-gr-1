Feature: I would like to edit malbork

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Malbork"
    And I go to "/admin/malbork/"
    Then I should not see "<malbork>"
    And I follow "Create a new entry"
    Then I should see "Malbork creation"
    When I fill in "Name" with "<malbork>"
    And I fill in "Caption" with "<caption>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<malbork>"
    And I should see "<caption>"
    And I should see "<size>"

  Examples:
    | malbork     | caption   | size    |
    | Francuska   | centrum   | 123     |
    | Zelazna     | obwodnica | 445     |
    | Sadowa      | osiedle   | 785     |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Malbork"
    And I go to "/admin/malbork/"
    Then I should not see "<new-malbork>"
    When I follow "<old-malbork>"
    Then I should see "<old-malbork>"
    When I follow "Edit"
    And I fill in "Name" with "<new-malbork>"
    And I fill in "Caption" with "<new-caption>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-malbork>"
    And I should see "<new-caption>"
    And I should see "<new-size>"
    And I should not see "<old-malbork>"

  Examples:
    | old-malbork     | new-malbork  | new-caption            | new-size|
    | Francuska       | Warecka      |nowa-ulica              |123      | 
    | Zelazna         | Mazurow      | stare miasto           |445      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Malbork"
    And I go to "/admin/malbork/"
    Then I should see "<malbork>"
    When I follow "<malbork>"
    Then I should see "<malbork>"
    When I press "Delete"
    Then I should not see "<malbork>"

  Examples:
    |  malbork    |
    | Sadowa      |
    | Warecka     |
    | Mazurow     |