import React, { useRef } from 'react';
import { View, Text, StyleSheet, TouchableOpacity, Image, Dimensions } from 'react-native';
import SignatureScreen from 'react-native-signature-canvas';

export default function ApprenantSignatureCanvasMobile() {
  const ref = useRef(null);

  const handleOK = (signature: string) => {
    console.log('Signature sauvegardée : ', signature);
    // ici, appeler une API pour sauvegarder la signature
  };

  const handleClear = () => {
    ref.current?.clearSignature();
  };

  return (
    <View style={styles.container}>
      <View style={styles.header}>
        <View style={styles.avatar}><Text style={styles.avatarText}>AK</Text></View>
        <Image source={require('../assets/gefor-logo.png')} style={styles.logo} />
      </View>

      <Text style={styles.title}>Emargement</Text>
      <Text style={styles.subtitle}>veuillez signer dans le cadre</Text>

      <View style={styles.signatureWrapper}>
        <SignatureScreen
          ref={ref}
          onOK={handleOK}
          autoClear={false}
          descriptionText="SIGNEZ ICI"
          webStyle={customStyle}
        />
      </View>

      <TouchableOpacity style={styles.button} onPress={() => ref.current?.readSignature()}>
        <Text style={styles.buttonText}>Sauvegarder</Text>
      </TouchableOpacity>

      <View style={styles.footer}>
        <TouchableOpacity><Text style={styles.footerItem}>🏠\nAccueil</Text></TouchableOpacity>
        <TouchableOpacity><Text style={styles.footerItem}>📅\nCalendrier</Text></TouchableOpacity>
        <TouchableOpacity><Text style={styles.footerItem}>👤\nProfil</Text></TouchableOpacity>
      </View>
    </View>
  );
}

const customStyle = `
  .m-signature-pad--footer { display: none; margin: 0; }
  .m-signature-pad { box-shadow: none; border: none; }
  .m-signature-pad--body { border: 2px solid #ccc; }
  .m-signature-pad--body::before { content: 'SIGNEZ ICI'; color: #ccc; font-size: 20px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-weight: bold; }
`;

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#F1F3F5',
    paddingTop: 40,
    paddingHorizontal: 20
  },
  header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 10
  },
  avatar: {
    backgroundColor: '#E85421',
    width: 40,
    height: 40,
    borderRadius: 20,
    justifyContent: 'center',
    alignItems: 'center'
  },
  avatarText: {
    color: 'white',
    fontWeight: 'bold'
  },
  logo: {
    width: 100,
    height: 30,
    resizeMode: 'contain'
  },
  title: {
    textAlign: 'center',
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 5
  },
  subtitle: {
    textAlign: 'center',
    marginBottom: 10,
    color: '#212529'
  },
  signatureWrapper: {
    flex: 1,
    borderRadius: 12,
    overflow: 'hidden',
    height: Dimensions.get('window').height * 0.4
  },
  button: {
    backgroundColor: '#0E1E5B',
    padding: 15,
    borderRadius: 8,
    alignItems: 'center',
    marginVertical: 15
  },
  buttonText: {
    color: 'white',
    fontWeight: 'bold',
    fontSize: 16
  },
  footer: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    paddingVertical: 10,
    borderTopWidth: 1,
    borderColor: '#ccc',
    backgroundColor: '#fff'
  },
  footerItem: {
    textAlign: 'center',
    fontSize: 12,
    color: '#212529'
  }
});
