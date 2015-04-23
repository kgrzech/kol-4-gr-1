Feature: I would like to edit narol

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Narol"
    And I go to "/admin/narol/"
    Then I should not see "<narol>"
    And I follow "Create a new entry"
    Then I should see "Narol creation"
    When I fill in "Name" with "<narol>"
    And I fill in "Caption" with "<caption>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<narol>"
    And I should see "<caption>"
    And I should see "<size>"

  Examples:
    | narol     | caption        | size |
    | lwowska   | super ulica    | 111  |
    | polna     | fajne widoki   | 222  |
    | rynek     | wiele sklepow  | 333  |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Narol"
    And I go to "/admin/narol/"
    Then I should not see "<new-narol>"
    When I follow "<old-narol>"
    Then I should see "<old-narol>"
    When I follow "Edit"
    And I fill in "Name" with "<new-narol>"
    And I fill in "Caption" with "<new-caption>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-narol>"
    And I should see "<new-caption>"
    And I should see "<new-size>"
    And I should not see "<old-narol>"

  Examples:
    | old-narol     | new-narol          | new-caption          | new-size |
    | lwowska       | targowa            | zabytkowe kamienice  | 444      |
    | polna         | zielona            | czyste powietrze     | 555      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Narol"
    And I go to "/admin/narol/"
    Then I should see "<narol>"
    When I follow "<narol>"
    Then I should see "<narol>"
    When I press "Delete"
    Then I should not see "<narol>"

  Examples:
    |  narol    |
    | rynek     |
    | targowa   |
    | zielona   |