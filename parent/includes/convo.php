                <div class="span4" id="sidebar">
                    <table class="table table-striped" >
                                        <thead>
                                            <tr>
                                                <th><input type="text" class="span6" id="typeahead"  placeholder="Student Number" data-provide="typeahead" data-items="4" data-source='["2011","2012","2013","2014"]'></th>
                                                <th><button class="btn"><i class="icon-filter"></i> </button>
</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='records.php'? 'class="active' : '');?>
                            <a href="records.php"> Karen Anne Cumlat</a></td>
                                                <td><button class="btn"><i class="icon-trash"></i> </button>
</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Jacket</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Shoes</td>
                                            </tr>
                                        </tbody>
                                    </table>

                </div>