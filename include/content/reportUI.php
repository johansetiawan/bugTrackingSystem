<?php
    $bestdev = "SELECT * FROM user inner join user_developer on user.user_id=developer_id order by bugs_fixed DESC LIMIT 1";
    $bestrev = "SELECT * FROM user inner join user_reviewer on user.user_id=reviewer_id order by bugs_resolved DESC LIMIT 1";
    $besttri = "SELECT * FROM user inner join user_triager on user.user_id=triager_id order by bugs_closed DESC LIMIT 1";

    $dev = $base->query($bestdev)->fetch_array();
    $rev = $base->query($bestrev)->fetch_array();
    $tri = $base->query($besttri)->fetch_array();
?>

<div>
    <table>
        <tr>
            <th>
                Best Developer :
            </th>
            <th>
                <?php echo $dev['full_name'];?>
            </th>
        </tr>
        <tr>
            <th>
                Best Reviewer :
            </th>
            <th>
                <?php echo $rev['full_name'];?>
            </th>
        </tr>
        <tr>
            <th>
                Best Triager :
            </th>
            <th>
                <?php echo $tri['full_name'];?>
            </th>
        </tr>
    </table>
</div>