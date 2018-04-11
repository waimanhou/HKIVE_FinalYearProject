# Introduction
In this final stage, we have designed and implemented the proposed system which contains all required functions and user interfaces. In this Final Report, we are going to describe the system structure and applied technologies in the final prototype.


For better description, we divide this report into five main parts. 
1.	Requirements: Scope of the proposed system and description of functions provided.
2.	Problem analysis: Use case descriptions, use case diagrams, class diagram, state transition diagram and sequence diagrams.
3.	Detailed design: Data design, software architectural design (system design), applied technologies and user interface design.
4.	Implementation: Test plan, test results, changes to design and justification of changes.
5.	Results and Conclusion: Encountered problems, delays in project schedule, limitations of the proposed system and potential difficulties and suggestions for further development of the system.
6.	Reference: Source materials
7.	Appendices: Original project plan with segmentation of activities and estimated times for the completion and the log sheets of conversation with supervisor.
8.	Program listing: Some source code of important functions.
9.	User guide and Installation guide: Instruction for using the system.


In addition, we will demonstrate the final prototype of the proposed system after submission of this report. Thus, the demonstration may be little different from the report since we are keep improving on the system.


# Requirements


Due to the time limitation, we have to decide the scope of the proposed system and functions provided. 


## Scope of the proposed system

1.	Multi-language
For public user, we expect the system is easy to use. Concerning different user, we design a multi-language website including Traditional Chinese and English. 


2.	Create and Participate Sports Activities Platform
The proposed system provides a platform for members creating and participate sports activities with different members. Member can create their activity waiting other members to join. 


3.	Invitation Platform
The member can invite other member to join activities. Besides, the team leader can invite other members to join their team. Moreover, the member can invite other member as a friend. The friend list will be updated once the member accepts to be a friend. To join an activity, the member can invite their friend though the friend list.


4.	Credits and Points
Each member has a certain number of credits and points. The number of credits can represent the reputation and attitude of member. Every time a member hosts or participates an activity, he can gain certain amount of credits and points which depend on the comment of other member who had joined the activity.


5.	Gift Redemption and Gift Management
Member can use their points to redeem gift. The gifts are obtained from the sponsors and advertisers. Administrator can update the gift and the number of points required in the website.


6.	Advertisement Management
The system provides some areas for sponsors and advertisers advertising their product and company. Administrator can update the advertisements in the website. Advertisers provide the hyper link of the advertisement. Administrator will insert the advertisement into website.


7.	News Management
The system can show news in the home page. Administrator can manage the news in the website. The administrator can add/change/delete the news.


## Description of Provided Functions and Data Processing
The functionalities of the proposed systems are list below.

Actor Descriptions
User = Public user who use the system without login
Member = User have registered to be a member and have login in the system. 
Team Leader = Member who manage the team in the system.
Organization Leader = Member who manage the organization in the system.
Convener = Member who host an activity.


### Public Functions
1.	Registration: The user can register account in the system.
Data Processing: User needs provide their email address. The system will send an acknowledgement to their email. The user can use the link in the acknowledgement to register account in the system.
2.	Login/Logout: Member can login the system to use more functions.
Data Processing: User enters username and password to verify the account.
3.	Search activities: User can search activities in the system.
Data Processing: User enters the constraints to search activity.

### Basic Functions
1.	Member can modify account information.
Data Processing: Member can edit the account information in the form. All information will be updated after click “submit”.
2.	Member can invite friend adding them into friend list. 
Data Processing: Member enters a username in the textbox. The system finds a user which matches the username. If user exists, the system sends an invitation message to that user. 
3.	Member can check their activity schedule.
Data Processing: The system finds and displays the member’s activities which were applied and completed.

### Create and Participate Sports Activities Platform
This platform allows members to participate sports activities which are created by other members. Member can create a sports activity which is no player or insufficient players before.

After login the account,
1.	Member can attend the sports activities.
Data Processing: The member has to join a team to sign up the activity. The member provides the information to apply a team. The member needs to be accepted by team leader and selected by the convener.
2.	Member needs to give feedback after finish the activity.
Data Processing: The member writes the comment in a text area and selects a feedback in radio button for the opposite team. The system stores the comment and feedback in the database. 
3.	Member can gain credit and points.
Data Processing: The system changes the credits and points for the members of opposite team. For example, if they got a positive feedback, they can get 1 credit and 5 points. If they got a neutral feedback, they can only get 5 points. If they got a negative feedback, they only lose 1 credit.
4.	Member can create the sports activities in the system.
Data Processing: Member has to provide the require information about the activity such as title, date, time, location, number of people and team required and permit of the venue. The system will create a activity.


After create an activity,
1.	Convener can invite member and team.
Data Processing: Convener can enter the username of invited member. The system checks whether the member exists. The system sends an invitation to that member. The member can accept it to join the activity. Besides, the convener can invite team to join the activity by entering the name of team. The system checks whether the team exists. The system sends an invitation to that team leader. The team leader can accept it to join the activity.
2.	Convener can cancel the activity.
Data processing: The convener can cancel the activity. The system will send the messages to all involved member.


### Gift Redemption
Administrator can manage the gift which provided by sponsors. Also, member can use their points to redeem gift.
1.	Member can redeem gift using their points.
Data processing: Member can select gifts to be redeemed. The system checks whether the member has enough points. If true, the system will decrease his/her points and send a redemption successful message to administrator for processing the further procedures.
2.	Administrator can add gift from the gift list.
Data processing: Administrator can add new gift in the system by entering the name of gift, number of gift and required points.
3.	Administrator can change gift from the gift list.
Data processing: Administrator can change the gift in the system including name of gift, number of gift and required points.
4.	Administrator can remove gift from the gift list.
Data Processing: Administrator can remove the gift in the system manually. However, the system can remove the gift automatically if the number of the gift is zero. 


### Team Management
Team leader can use his/her account to manage the team.
1.	Member can create a team.
Data Processing: Member can create a team by only entering name of team. The system checks the name whether the team exists. If not, the system creates a new team and the member becomes the team leader.
2.	Team can invite new team member.
Data Processing: Team leader can invite new team member by entering the username in the textbox. The system checks whether the user exists. If yes, the system sends an invitation to that member. If the invited member accepts, he/she joins the team.
3.	Team can accept member application for joining team.
Data Processing: If other members want to join the team, they can send a request to the team leader. The team leader decides whether the member should join the team.
4.	Team can remove team member.
Data Processing: Team leader can remove team member form the team. The removed member will receive a message.
5.	Team can update team information.
Data Processing: Team leader can update team information by editing the information in the form.
6.	Team can accept invitation from organization.
Data Processing: Organization leader can send an invitation to the team leader. The team leader can decide whether the team should join the organization.
7.	Team can apply to join the organization.
Data Processing: Team leader can apply to join the organization by sending a request to the organization leader.

### Organization Management
Organization leader can use his/her account to manage the organization.
1.	Member can create an organization
Data Processing: The member can create a new organization by only entering the name of organization. The system checks whether the organization exists. If not, the organization will be created in the system and the member becomes the organization leader.
2.	Organization can invite team to join the organization.
Data Processing: Organization leader can invite team to join the organization by sending an invitation message to the team leader.
3.	Organization can accept team application for joining the organization.
Data Processing: Organization leader can accept team application which sent by the team leader.
4.	Organization can remove team from the organization.
Data Processing: If a team is removed in the organization. The involved team leader and team member receive a message.
5.	Organization can update organization information.
Data Processing: Organization leader edit the information in the form. The system update the information.

### Advertisement Management
Since the proposed system is free to public, our income only come from advertisement. Therefore a management for advertisement is needed.
1.	Administrator can add advertisement into the system.
Data Processing: Administrator adds a hyperlink of advertisement and selects the location in the system. The advertisement can be displayed in the system.
2.	Administrator can change advertisement into the system.
Data Processing: Administrator changes the hyperlink of advertisement in the system to display the new advertisement.
3.	Administrator can delete advertisement into the system.
Data Processing: Administrator deletes the hyperlink of advertisement in the system to remove the advertisement.


### News Management
Administrator can login his account to manage the news in the front page,
1.	Administrator can add news.
Data Processing: Administrator adds news in the system by entering a title and content. The news will be displayed in the home page.
2.	Administrator can change news.
Date Processing: Administrator can change the news by edit the content of it. The system updates the news. 
3.	Administrator can delete news.
Data Processing: Administrator can remove the news in the system by click the “Remove” button. The system sets the state of news to be “removed”.



### Information of Sports Venues Management
Administrator can login his account to manage the information of sports venues. The information of sports venues contains name, address, Google map link, facility and booking price.
1.	Administrator can add new information of sports venues.
Data Processing: Administrator can add new sports venues for hosting activity by entering the name of venue, phone number, location and type of venue. 
2.	Administrator can change information of sports venues.
Data Processing: Administrator can change the information of sports venues in the system. The system updated the information of related venues.
3.	Administrator can delete information of sports venues.
Data Processing: The system finds the related venues and set the state of it to be “removed”.

### Credits and Points Management
Administrator can login his account to manage the changing value of credits and points such as the increased credits and points for successful creating an activity.
1.	Administrator can edit the changing value of credits and points.
Data Processing: Administrator can increase or decrease the changing value of credits and points. After it, the system will change the credits and points according to the new value. The past changing in credits and points will not be re-calculated.
