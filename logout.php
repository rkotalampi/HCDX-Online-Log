<?
//
// Hard-Core-DX Online Log
// Copyright (C) 2009 Risto Kotalampi, risto@kotalampi.com
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.


// logout.php - destroys session and returns to login form

// destroy all session variables

session_start();
session_destroy();

// redirect browser back to login page
header("Location: /index.php");
?>
