<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $widgets = [
            ['title' => 'Student Enrollments', 'count' => 320, 'content' => 'Total students enrolled this semester.'],
            ['title' => 'Pending Approvals', 'count' => 12, 'content' => 'Profile updates awaiting admin approval.'],
            ['title' => 'Active Courses', 'count' => 25, 'content' => 'Number of currently active courses.'],
            ['title' => 'New Registrations', 'count' => 48, 'content' => 'Students registered this week.'],
            ['title' => 'Assignments Submitted', 'count' => 210, 'content' => 'Total assignments submitted this month.'],
            ['title' => 'Lectures Scheduled', 'count' => 18, 'content' => 'Upcoming lectures this month.'],
            ['title' => 'Attendance Rate', 'count' => 92, 'content' => 'Overall student attendance percentage.'],
            ['title' => 'Support Tickets', 'count' => 7, 'content' => 'Unresolved student support tickets.'],
            ['title' => 'System Notifications', 'count' => 3, 'content' => 'Unread system messages and alerts.'],
        ];

        $welcomeMessages = [
            "Welcome back! Here’s what’s happening with your students and classes today.",
            "Your daily student and class insights are ready. Take a look!",
            "Stay updated! Here’s a quick summary of today’s student activity.",
            "Good to see you! Here’s a snapshot of your students and classes.",
            "Here’s your personalized dashboard for managing students and classes.",
            "Your class updates are in! Check out today’s key stats.",
            "Stay on top of your schedule with these student and class insights.",
            "All set for the day? Here’s a quick look at your students and classes.",
            "Let’s make today productive! Here’s what’s happening in your courses.",
            "Catch up on the latest student activities and class updates here.",
        ];

        $welcomeMessage = $welcomeMessages[array_rand($welcomeMessages)];

        return view('dashboard', compact('widgets', 'welcomeMessage'));
    }
}
