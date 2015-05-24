Feature: I would like to edit Bruksela

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bruksela/"
    Then I should not see "<bruksela>"
    And I follow "Create a new entry"
    Then I should see "Bruksela creation"
    When I fill in "Name" with "<bruksela>"
    And I fill in "Caption" with "<caption>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<bruksela>"
    And I should see "<caption>"
    And I should see "<size>"

  Examples:
    | bruksela      | caption       | size |
    | pierwsza      | ul. Pierwsza  | 12   |   
    | druga         | ul. Druga     | 33   |
    | trzecia       | ul. Trzecia   | 14   |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bruksela/"
    Then I should not see "<new-bruksela>"
    When I follow "<old-bruksela>"
    Then I should see "<old-bruksela>"
    When I follow "Edit"
    And I fill in "Name" with "<new-bruksela>"
    And I fill in "Caption" with "<new-caption>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-bruksela>"
    And I should see "<new-caption>"
    And I should see "<new-size>"
    And I should not see "<old-bruksela>"

  Examples:
    | old-bruksela     | new-bruksela   | new-caption | new-size |
    | pierwsza         | N-E-W-P        | ul. Nowa4   |  22      | 
    | druga            | N-E-W-D        | ul. Nowa5   |  19      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bruksela/"
    Then I should see "<bruksela>"
    When I follow "<bruksela>"
    Then I should see "<bruksela>"
    When I press "Delete"
    Then I should not see "<bruksela>"

  Examples:
    |  bruksela  |
    | trzecia    |
    | N-E-W-P    |
    | N-E-W-D    |

