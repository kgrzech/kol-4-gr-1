Feature: I would like to edit lublin

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/lublin/"
    Then I should not see "<lublin>"
     And I follow "Create a new entry"
    Then I should see "Lublin creation"
    When I fill in "Name" with "<lublin>"
     And I fill in "Caption" with "<caption>"
     And I fill in "Size" with "<size>"
     And I press "Create"
    Then I should see "<lublin>"
     And I should see "<caption>"
     And I should see "<size>"

  Examples:
    | lublin      | caption    |size  |
    | Radości     | os.skarpa  |1223  |
    | Szczytowa   | os.górki   |2222  |
    | Sympatyczna | os.skarpa  |1234  |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/lublin/"
    Then I should not see "<new-lublin>"
    When I follow "<old-lublin>"
    Then I should see "<old-lublin>"
    When I follow "Edit"
     And I fill in "Name" with "<new-lublin>"
     And I fill in "Caption" with "<new-caption>"
     And I fill in "Size" with "<new-size>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-lublin>"
     And I should see "<new-caption>"
     And I should see "<new-size>"
     And I should not see "<old-lublin>"

  Examples:
    | old-lublin      | new-lublin  | new-caption |new-size|
    | Sympatyczna     | Bursztynowa | os.widok    |5521    |
    | Szczytowa       | Szczęśliwa  | os.skarpa   |111     |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/lublin/"
    Then I should see "<lublin>"
    When I follow "<lublin>"
    Then I should see "<lublin>"
    When I press "Delete"
    Then I should not see "<lublin>"

  Examples:
    |  lublin     |
    | Radości     |
    | Bursztynowa |