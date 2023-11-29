<?php

class Partner extends Dbh
{
    public function fetchPartners($uid)
    {
        $stmt = $this->connect()->prepare("SELECT Name FROM streamers, partner, brands WHERE streamers.StreamerID = ? AND streamers.StreamerID = partner.StreamerID AND partner.BrandID = brands.BrandID");

        if (!$stmt->execute($uid)) {
            $stmt = null;
            header("location: ../profile.php?error=stmtfailed");
            exit();
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                echo "<p>" . $row["Name"] . "</p>";
            }
        } else {
            echo "none";
        }
    }
}