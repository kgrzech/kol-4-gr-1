Feature: I would like to edit Chelm

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/chelm/"
    Then I should not see "<chelm>"
    And I follow "Create a new entry"
    Then I should see "Chelm creation"
    When I fill in "Name" with "<chelm>"
    And I fill in "Caption" with "<caption>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<chelm>"
    And I should see "<caption>"
    And I should see "<size>"

  Examples:
    | chelm      | caption       | size |
    | andersa    | ul. Andersa   | 12   |   
    | babinicza  | ul. Babinicza | 33   |
    | cementowa  | ul. Cementowa | 14   |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/chelm/"
    Then I should not see "<new-chelm>"
    When I follow "<old-chelm>"
    Then I should see "<old-chelm>"
    When I follow "Edit"
    And I fill in "Name" with "<new-chelm>"
    And I fill in "Caption" with "<new-caption>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-chelm>"
    And I should see "<new-caption>"
    And I should see "<new-size>"
    And I should not see "<old-chelm>"

  Examples:
    | old-chelm     | new-chelm   | new-caption | new-size |
    | andersa       | N-E-W-A-N-D | ul. Cisowa  |  22      | 
    | babinicza     | N-E-W-B-A-B | ul. Chopina |  19      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/chelm/"
    Then I should see "<chelm>"
    When I follow "<chelm>"
    Then I should see "<chelm>"
    When I press "Delete"
    Then I should not see "<chelm>"

  Examples:
    |  chelm      |
    | cementowa   |
    | N-E-W-A-N-D |
    | N-E-W-B-A-B |

