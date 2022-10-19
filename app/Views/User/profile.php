<?= $this->extend('common') ?>

<?= $this->section('body') ?>

    <div class="profile_edit right-align" style="margin:25px">
        <a href="<?= base_url() ?>/User/edit" class="btn-floating waves-effect edit-button"><i class="material-icons">edit</i></a>
    </div>


        <div class="container center-align center-flex-ux">
            <input type="file" id="image" accept="image/*">

            <label for="image" class="container center-align">
                <?php if ($profile_image !== NULL): ?>
                    <img class="circle" id="thumbnail-view" src="<?= session()->get('profile_image')?>" width="180" height="180">
                <?php endif; ?>
                <?php if ($profile_image === NULL): ?>
                    <img class="circle" id="thumbnail-view"
                         src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAMAAABHPGVmAAACuFBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD///8AAlQ7AAAA5nRSTlMAAQIDBAYHCAkKCwwNDg8QERITFBUWFxgZGhscHR4fICEiIyQlJicoKSorLC4vMDEyMzQ1Nzg5Ojs8P0BBQkNERUZHSktMTU9QUVJTVVZXWFlaW1xdXl9gYWJjZGVmZ2lqa2xtbm9wcXJzdHV2eHl6e3x9fn+AgYKDhIWGh4iJiouMjY6PkZKUlpeYmZydnp+goaKkpaanqKmqq6ytrq+wsbKztLW2t7i5uru8vcDBwsPExcbHyMnKy83P0NHT1NbX2tvc3d7f4OHi4+Tl5ufo6err7O3u7/Dx8vP09fb3+Pn6+/z9/hUI4qIAAAABYktHROe2a2qTAAAIUElEQVRo3rWa+2PUxRHA5w4kcCQlyDMhwRCigCiEakuLAkKtESSoCG0VFDUkttYiFkRKsICeQCkmQMOjBow82mhrK60EoYQm5AgYOMjRXM68IJfcfT9/R3+4C3nc7t4lJPsT3Ez2893d2dmZnRWJrdlHz81xlpxxeVsCgRav60yJM2fuaLv0X7Onry6qtohoVnXR6vR+AQ2auaVCAbgDqtgyc9BdIsbklncSgr6qspPFBw4Unyyr8gU7OeW5Y+4C8cCuxnBH7ZUFOXOSh3aKhibPySmobA+LG3c90EfE/fv8oS68RcuSbCoNW9ILRd6Qjn/f/X1AjHS2hv76aJbDpOfIOhr6llbnyF4ibCs8AHg2JkdXTt4YVl5h6w0jtRQA95phsekPW+MGoDQ19mFk1wE0rHPE/lmOdQ0AddkxDiZuhwVYhyf0boYnHLYAa0dcLMrjTgG4s3pvK1lugFPjomtOdQGUjO2L0Y8tAXBNjaY3ywO0re2jpxi0tg3wzDJrza4HfE9qpPHTnlj+Sm7uK8ufmBavUXnSB9TPNo6jHqiZoRIlPLPnwu1Ox3j7wp5nElR6M2qAesNYpnoAV5pC8vCe5kgP3LznYYVqmgvwTNHalQtwKSx3fGFA7egDBeMVtuwCqjQ2FncKqFGMY/71kKe/XLzhFwtnZ2b+cMHP1hdfDvl69zzFWGqAU8r9YtsB+BTrke0HuLJherdD0P7ghisA/iWKdfEBO1R7P9uCNoVdLfAD/3td8WFxr9cB/gUKG2sDK1vhE+uAtZG/J9UCp9PUM5xWBtQmRQrWAnUR3tJWCpQo9uAB4F/f09nKiH8DBxS78jOgtOeErQDcCl+SGYBag6tM8UAgU2GpbmBFj3PQA5bKJ+4GXjLt35XAbpW3tMDT/ax0AocVqkNuwpV7TJB7auDmEIXgMODsFjO0QoNqUh6xYKvZ3X0I1iOq86UBWrtGF/uAdaoeVgE/MUOeAlapBOuAfV3iKz+4lWdtPlgZZsgUIF95IrvB3xmP7QLWKHvYCcF7zZDRQdiplKwBdt2JRRvBo45LnBAcZYbcG+yxwJ0xjAcaOyLYXGCjuodtEIxyZo8Jwja1aCOQG96d5eBPHghIsh/KQ15kpgVHZSAgchSsmSIisgXI6jtkrAGSBWwREbFXgNcxMBCHFyrsIpJuQZEMDESKwEoXkdXAsoGCLANWh2DtSXcBGWeCJLVDkYi9Giq1ofjB2CAHtQlCJVTbZbQFBTqd+YHYIIH5OmkBWKNlLpCjU/kC2BYl47BtB77QSXOAuZIDzNFoJDTDN1GzGts30JygEc4BcsQJQV1eOAnYFD2W3wRM0uWTQXBKCfiG6mJj4O3okLcBXU4y1AclcgaqZOAgUgVnxAVlAwkpA5d44eRAQk6CV1qgeCAhxdAiAWWY2X+QAxAwQu4DNkeHvA+kGyEtcESnEN8E56ImwoPKoUW3GeUItBgXXk4Au4aaGYkfA38T48KbTFjmBNDFOx3t1z4guEArPw0uOQ2X9F3kW1BpjLevAmzXOzgXnDa6FRH7cQhMMkAWALfW6dctzgcl4oRgir6Tn3fGZ8q2H1hokKcEwWl09SIy1g/n9JOR3AIXTYfBY0COzNcG26F2HIKPaqWbgd+Y1iwXmC+jLCg0aD0NfKKNHr3QaIz694I1SuyXw/GXpg12QdtDGqET+NDEsFdAtT0UEpmuTFcDx9TT/uAtaDBet05ohz+JyMvA8wa9IdUQXKQc5FfAeuNWfR54WUQmW4a4SURkCVCTqBD8ErgUb4QcBGuyiNgvQJ3p/tf+OVAYOWE/9kNgofm+2AsX7B2pwyJj6tkEVsSMJl7XXBN0aYs7UgeZYUiCQu1V4P2eP2YA/4lyPV0CVuhyy34eWo03zUk6yDtR7qNb4Xx4e+TpE9NOyO/7AHkPeCP871ENUOvof4ijFhruJOh/APL6H5LXzTIyWuHa8P6GDL8GrRndT4Xf6tUnA7+LiMatKNH4emB/115uQYP+6HounPl1zyuC8KnpuGqEWxk9Lq30gaTjPDA94uf/wu3pesiRCA898gZYT2s+6Uvg68jT4C2gKlPHWGRBbY+j5gXghio7HLG5GWj7kWJhLwNtherS3/gbwPKeOdlfgWODI3KYnFqA9ldVHT3aAOBXYQYfV13ZyoS6yCvCwc9eBOD6YvWUfL8yVGEsjKiXvgN4FZa0JAhtP+06uHllADTla6uUw/KuhjB7u2OeaofgUlUS+xHw3cw7/3/oRBCgvcBYOxyeey0Sk9kAfKQ8suP+CVwN5wApH7cBWH+ZES2oH/5GqPLhL+zYFOlXga80pcAxVUB1ioiMyA8Vfs7Oi6U26Qhj2vZmiIikVgMXteW9qTeAS+mDc24CcOm5WJ8NDMtzhzFpMvkSUDtFr5xZD1w7C8DNvDiJvXVgmre6oxTORH7g7SiKbUmU3jVH3rWOUpd3tll1lhfA2jdRet8cYYO+OSuaZua3AMeT+gCR8Z8DfJsZXTP5HwC1i3rPWFwLcCqm6veQrUHA+iStd4iJf7aA4PYhsX5SHUDzu70p+r/bBFC3OPY/Sfks5BjfSohNP+HNkAGfSO3V4LNDm9i7KQYzS82vD33TUlsvVzFxa8iztJcuHW50XUtLQ09kWj5I7INBpuwOl8a/K1k1Uelg7Kkrj/rCpfM/9mVniYhk7KjveObjOvyruWnxd6bDFn/f428equp45uPbmSF9byNeO9vlZVLT5bK/Hzt06NiXZ640dXnHdO61RLm7Zpv23vmA/ulVoHzjtH554mVLeXFvhQIUqNz/YopN+q/ZEh97afPBrytq6v3++quVpw/lr3x8ZKyA/wNWHEpqJq5VAQAAAABJRU5ErkJggg== "
                         width="180" height="180">
                <?php endif; ?>
            </label>

            <button id="Update" class="profile_pic btn waves-effect waves-light btn-block col s12 hide"><?php echo lang('Lang.profile.image'); ?></button>

        </div>


    <div class="container">
    <div class="row center-align">
        <div class="col s12">
            <h3><?= $firstname ?> <?= $lastname ?></h3>
        </div>
        <div class="row">
            <h5><i><?= $username ?></i></h5>
        </div>
    </div>

    <br/>

    <div class="row">
        <div class="col s6">
            <div class="container center-align">
                <div class="row">
                    <a href="#" class="btn-floating">
                        <i class="medium material-icons green">linked_camera</i>
                    </a>
                    <h7><?= $snappCount ?></h7>
                </div>
                <h5><?php echo lang('Lang.profile.snapp'); ?></h5>
            </div>
        </div>

        <div class="col s6">
            <div class="container center-align">
                <div class="row center-align">
                    <a href="#" class="btn-floating">
                        <i class="medium material-icons green">explore</i>
                    </a>
                    <h7><?= $advCount ?></h7>
                </div>
                <h5><?php echo lang('Lang.profile.adventures'); ?></h5>
            </div>
        </div>
    </div>

    <br>
    <h5><?php echo lang('Lang.profile.by_me'); ?></h5>
    <div id="vertical-menu">
        <div class="container center-align">
            <?= $content ?>
        </div>
    </div>

<?= $this->endSection() ?>