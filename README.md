Summary

We are in need of a small website that will allow users to rate and review fundraisers. The user can go to the site, leave their name and email address, and provide a one-time rating and review of a fundraiser they have used. The main page of the site will list out all fundraisers, ordered by rating (best to worst), and a link should be presented to allow users to enter a new review.

Technical Requirements

Coding Challenge
1. PHP MVC Framework of your choice.
2. Incorporate Twitter Bootstrap for UI styling
3. Store the following data in a MySQL Database:

Fundraiser 
Name
Rating
Review
Reviewer Name
Reviewer Email
Review Date

4. Include Unit Tests if time permits.

Additional User Requirements
1. Rating should be between 1-5 stars. The email address should be a valid email address.
2. All required fields should include proper validation on both front and back-end.
3. Reviewers cannot enter more than one review for the same fundraiser.
4. The user can enter a new fundraiser name if the fundraiser is not in the list of fundraisers to review.

I've chosen to use CodeIgniter  CI3.1.8 as the framework with PHP 5.6.35, MySql v5.5.59, Bootstrap 4.1.0, and jQuery 3.2.1, along with a couple of open-source jQuery plugins.

I have 2 controllers (Home.php, and Review.PHP), a single model (Booster.php), and 3 views (view_home, view_process, and view_review). 


