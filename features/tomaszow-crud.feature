Feature: I would like to edit Tomaszow

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Tomaszow"
    And I go to "/admin/Tomaszow/"
    Then I should not see "<Tomaszow>"
    And I follow "Create a new entry"
    Then I should see "Tomaszow creation"
    When I fill in "Name" with "<Tomaszow>"
    And I fill in "Caption" with "<caption>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<Tomaszow>"
    And I should see "<caption>"
    And I should see "<size>"

  Examples:
    | tomaszow  | caption        | size |
    | lwowska   | super ulica    | 111  |
    | polna     | fajne widoki   | 222  |
    | rynek     | wiele sklepow  | 333  |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Tomaszow"
    And I go to "/admin/Tomaszow/"
    Then I should not see "<new-Tomaszow>"
    When I follow "<old-Tomaszow>"
    Then I should see "<old-Tomaszow>"
    When I follow "Edit"
    And I fill in "Name" with "<new-Tomaszow>"
    And I fill in "Caption" with "<new-caption>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-Tomaszow>"
    And I should see "<new-caption>"
    And I should see "<new-size>"
    And I should not see "<old-Tomaszow>"

  Examples:
    | old-Tomaszow  | new-Tomaszow       | new-caption          | new-size |
    | lwowska       | targowa            | zabytkowe kamienice  | 444      |
    | polna         | zielona            | czyste powietrze     | 555      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Tomaszow"
    And I go to "/admin/Tomaszow/"
    Then I should see "<Tomaszow>"
    When I follow "<Tomaszow>"
    Then I should see "<Tomaszow>"
    When I press "Delete"
    Then I should not see "<Tomaszow>"

  Examples:
    | Tomaszow  |
    | rynek     |
    | targowa   |
    | zielona   |