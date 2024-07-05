#! /bin/bash
echo "starting zipme.sh"
cd ../
if test -f juweelwinkel-wristler.zip; then
    rm -rf juweelwinkel-wristler.zip
    echo "removed juweelwinkel-wristler.zip"
fi
cd juweelwinkel-wristler
zip -r ../juweelwinkel-wristler.zip . -x "node_modules/*" "*.idea*" "*.DS_Store*" "zipme.sh"
echo "finished zipme.sh"