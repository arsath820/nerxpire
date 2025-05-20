<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->latest() === FALSE) //Essentially, it's telling CodeIgniter: 
        // "Apply all migrations that haven't been run yet, up to the latest migration file."
        {
            show_error($this->migration->error_string());
        }
        else {
            echo "Migration executed successfully.";
        }
    }

    public function reset()
    {
        $this->load->library('migration');

        if ($this->migration->version(0) === FALSE) // hard swipe using down()
        {
            show_error($this->migration->error_string());
        }
        else {
            echo "Migration reset to version 0.";
        }
    }

    public function rollback_one()
    {
        // Load the migration library
        $this->load->library('migration');
    
        // Step 1: Get the current migration version from the database
        $current_version = $this->db->get('migrations')->row()->version;
    
        // Step 2: Get all migration files in the migrations folder
        $files = glob(APPPATH . 'migrations/*.php');
        $versions = []; //will hold the list of version numbers (timestamps) extracted from the filenames.
    
        // Step 3: Extract the version number (timestamp) from each migration file
        foreach ($files as $file) {
            $basename = pathinfo($file, PATHINFO_FILENAME); // Get the filename without extension
            $timestamp = substr($basename, 0, 14); // Extract the first 14 characters (timestamp)
            
            // Check if the extracted value is a valid number (it should be)
            if (is_numeric($timestamp)) {
                $versions[] = (int)$timestamp; // Convert it to an integer and store in the version array
            }
        }
    
        // Step 4: Sort the versions array in ascending order (oldest to newest)
        sort($versions);
    
        // Step 5: Find the previous version (just before the current one)
        $prev_version = 0;
        foreach ($versions as $version) {
            if ($version < $current_version) {
                $prev_version = $version; // Set previous version if it's smaller than current version
            } else {
                break; // Once we find the current version, we can stop looking
            }
        }
    
        // Step 6: Roll back to the previous version
        if ($this->migration->version($prev_version) === FALSE) { //uses down() from migration class
            show_error($this->migration->error_string()); // Show error if rollback fails
        } else {
            echo "Rolled back to version $prev_version."; // Success message after rollback
        }
    }
    
}
