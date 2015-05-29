Feature: I would like to edit Bialystok

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bialystok/"
    Then I should not see "<bialystok>"
    And I follow "Create a new entry"
    Then I should see "Bialystok creation"
    When I fill in "Name" with "<bialystok>"
    And I fill in "Caption" with "<caption>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<bialystok>"
    And I should see "<caption>"
    And I should see "<size>"

  Examples:
    | bialystok  | caption        | size |
    | raz        | ul. Czarna     | 11   |   
    | dwa        | ul. Biala      | 22   |
    | trzy       | ul. Czerwona   | 33   |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bialystok/"
    Then I should not see "<new-bialystok>"
    When I follow "<old-bialystok>"
    Then I should see "<old-bialystok>"
    When I follow "Edit"
    And I fill in "Name" with "<new-bialystok>"
    And I fill in "Caption" with "<new-caption>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-bialystok>"
    And I should see "<new-caption>"
    And I should see "<new-size>"
    And I should not see "<old-bialystok>"

  Examples:
    | old-bialystok     | new-bialystok   | new-caption     | new-size |
    | raz               | N-E-W-C         | ul. Newczarna   |  44      | 
    | dwa               | N-E-W-B         | ul. Newbiala    |  55      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bialystok/"
    Then I should see "<bialystok>"
    When I follow "<bialystok>"
    Then I should see "<bialystok>"
    When I press "Delete"
    Then I should not see "<bialystok>"

  Examples:
    |  bialystok  |
    |  trzy       |
    |  N-E-W-C    |
    |  N-E-W-B    |

