Feature: I would like to edit tomaszow

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Tomaszow"
    And I go to "/admin/tomaszow/"
    Then I should not see "<tomaszow>"
    And I follow "Create a new entry"
    Then I should see "Tomaszow creation"
    When I fill in "Name" with "<tomaszow>"
    And I fill in "Caption" with "<caption>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<tomaszow>"
    And I should see "<caption>"
    And I should see "<size>"

  Examples:
    | tomaszow  | caption        | size |


  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Tomaszow"
    And I go to "/admin/tomaszow/"
    Then I should not see "<new-tomaszow>"
    When I follow "<old-tomaszow>"
    Then I should see "<old-tomaszow>"
    When I follow "Edit"
    And I fill in "Name" with "<new-tomaszow>"
    And I fill in "Caption" with "<new-caption>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-tomaszow>"
    And I should see "<new-caption>"
    And I should see "<new-size>"
    And I should not see "<old-tomaszow>"

  Examples:
    | old-tomaszow  | new-tomaszow       | new-caption          | new-size |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Tomaszow"
    And I go to "/admin/tomaszow/"
    Then I should see "<tomaszow>"
    When I follow "<tomaszow>"
    Then I should see "<tomaszow>"
    When I press "Delete"
    Then I should not see "<tomaszow>"

  Examples:
    | tomaszow  |
