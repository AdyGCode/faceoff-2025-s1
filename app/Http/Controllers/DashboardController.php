<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
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
        
        return view('dashboard', compact('widgets'));
    }
}
